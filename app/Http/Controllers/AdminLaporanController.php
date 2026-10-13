<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanActivityLog;
use App\Models\User;
use App\Services\CvssCalculatorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use InvalidArgumentException;

class AdminLaporanController extends Controller
{
    public function __construct(private readonly CvssCalculatorService $cvss) {}

    /**
     * Display all reports for admin review (list).
     * Supports blind-index email search (HMAC-SHA256) and plaintext fallback search.
     * Gate: LaporanPolicy::viewAny() — admin only via before() hook.
     */
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Laporan::class);

        $query = Laporan::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            // Compute deterministic blind index token (SHA-256) for encrypted email lookup
            $blindIndexToken = User::hashEmail($search);

            $query->where(function ($q) use ($search, $blindIndexToken) {
                // Exact match on reporter's encrypted email via blind-index column
                $q->whereHas('user', function ($userQuery) use ($blindIndexToken) {
                    $userQuery->where('email_hash', $blindIndexToken);
                })
                // Fallback search on non-sensitive plaintext columns
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('target_url', 'like', "%{$search}%")
                ->orWhere('jenis_kerentanan', 'like', "%{$search}%")
                ->orWhere('pseudonym', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $laporans = $query->paginate(10)->withQueryString();

        return view('admin-laporan', compact('laporans'));
    }

    /**
     * Display a single report for detailed review.
     * UUID is exposed in the URL via route-model binding on {laporan:uuid}.
     *
     * Gate: LaporanPolicy::view() — admin only via before() hook.
     *
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID column
     */
    public function show(Laporan $laporan): View
    {
        Gate::authorize('view', $laporan);

        $laporan->load(['user', 'activityLogs' => function ($query) {
            $query->with('causer')->latest('created_at');
        }]);

        return view('admin-laporan-show', compact('laporan'));
    }

    /**
     * Validate and score a vulnerability report.
     *
     * Gate: LaporanPolicy::update() — admin only via before() hook.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function validasi(Request $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('update', $laporan);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['Menunggu', 'Valid', 'Ditolak'])],
            'poin'   => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        DB::transaction(function () use ($laporan, $validated, $request) {
            $laporan = Laporan::lockForUpdate()->findOrFail($laporan->id);

            $oldStatus = $laporan->status;
            $oldPoin   = (int) $laporan->poin_diberikan;

            // ── Anonymity gate (UU PDP / deanonymization prevention) ──────────────────
            // Anonymous reports MUST NOT contribute reputation points.
            // Awarding points to a public leaderboard counter would create a timing/delta
            // correlation that could deanonymize the reporter.
            $isAnonymous      = (bool) $laporan->is_anonymous;
            $effectivePoin    = $isAnonymous ? 0 : (int) $validated['poin'];

            $laporan->update([
                'status'         => $validated['status'],
                'poin_diberikan' => $effectivePoin,
            ]);

            $hunter    = User::whereKey($laporan->user_id)->lockForUpdate()->firstOrFail();
            $newPoin   = (int) $hunter->poin;

            // Reverse previous points if the report was previously Valid.
            if ($oldStatus === 'Valid') {
                $newPoin -= $oldPoin;
            }

            // Only credit reputation when validated AND not anonymous.
            if ($validated['status'] === 'Valid' && ! $isAnonymous) {
                $newPoin += $effectivePoin;
            }

            $newPoin = max(0, $newPoin);

            User::whereKey($hunter->id)->update([
                'poin' => $newPoin,
            ]);

            // Enhancement 2 — Audit trail: status updated
            LaporanActivityLog::record(
                laporan: $laporan,
                causer:  $request->user(),
                action:  'STATUS_UPDATED',
                details: [
                    'old_status'      => $oldStatus,
                    'new_status'      => $validated['status'],
                    'old_poin'        => $oldPoin,
                    'new_poin'        => $effectivePoin,
                    'poin_suppressed' => $isAnonymous,
                ],
                request: $request,
            );

            Log::info('AUDIT TRAIL — Laporan Divalidasi', [
                'admin_id'        => $request->user()?->id,
                'laporan_id'      => $laporan->id,
                'old_status'      => $oldStatus,
                'new_status'      => $validated['status'],
                'poin'            => $effectivePoin,
                'poin_suppressed' => $isAnonymous,
                'ip_address'      => $request->ip(),
            ]);
        });

        return back()->with('pesan', 'Laporan berhasil divalidasi dan poin telah diupdate!');
    }

    /**
     * Compute and save a CVSS v3.1 Base Score for a report.
     *
     * Enhancement 1 — CVSS v3.1 Scoring (ISO/IEC 30111).
     * Gate: LaporanPolicy::update() — admin only via before() hook.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function saveCvss(Request $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('update', $laporan);

        $validated = $request->validate([
            'cvss_av' => ['required', Rule::in(['N', 'A', 'L', 'P'])],
            'cvss_ac' => ['required', Rule::in(['L', 'H'])],
            'cvss_pr' => ['required', Rule::in(['N', 'L', 'H'])],
            'cvss_ui' => ['required', Rule::in(['N', 'R'])],
            'cvss_s'  => ['required', Rule::in(['U', 'C'])],
            'cvss_c'  => ['required', Rule::in(['N', 'L', 'H'])],
            'cvss_i'  => ['required', Rule::in(['N', 'L', 'H'])],
            'cvss_a'  => ['required', Rule::in(['N', 'L', 'H'])],
        ]);

        $metrics = [
            'AV' => $validated['cvss_av'],
            'AC' => $validated['cvss_ac'],
            'PR' => $validated['cvss_pr'],
            'UI' => $validated['cvss_ui'],
            'S'  => $validated['cvss_s'],
            'C'  => $validated['cvss_c'],
            'I'  => $validated['cvss_i'],
            'A'  => $validated['cvss_a'],
        ];

        try {
            $score  = $this->cvss->calculate($metrics);
            $vector = $this->cvss->buildVector($metrics);
        } catch (InvalidArgumentException $e) {
            return back()->withErrors(['cvss' => 'CVSS calculation error: ' . $e->getMessage()]);
        }

        $laporan->update([
            'cvss_score'  => $score,
            'cvss_vector' => $vector,
        ]);

        // Enhancement 2 — Audit trail: CVSS assigned
        LaporanActivityLog::record(
            laporan: $laporan,
            causer:  $request->user(),
            action:  'CVSS_ASSIGNED',
            details: [
                'cvss_score'  => $score,
                'cvss_vector' => $vector,
                'metrics'     => $metrics,
            ],
            request: $request,
        );

        Log::info('AUDIT TRAIL — CVSS Skor Ditetapkan', [
            'admin_id'    => $request->user()?->id,
            'laporan_id'  => $laporan->id,
            'cvss_score'  => $score,
            'cvss_vector' => $vector,
            'ip_address'  => $request->ip(),
        ]);

        return back()->with('pesan', "CVSS v3.1 Score {$score} ({$this->cvss->severityRating($score)}) berhasil disimpan.");
    }

    /**
     * Override quarantined PoC file to clean status with analyst justification.
     *
     * Gate: LaporanPolicy::update() — admin only via before() hook.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function overrideQuarantine(Request $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('update', $laporan);

        $validated = $request->validate([
            'alasan_override' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $oldScanStatus = $laporan->scan_status;

        $laporan->update([
            'scan_status' => 'clean',
        ]);

        // Record immutable audit log (NIST SP 800-61 Compliance)
        LaporanActivityLog::record(
            laporan: $laporan,
            causer:  $request->user(),
            action:  'QUARANTINE_OVERRIDDEN',
            details: [
                'previous_status' => $oldScanStatus,
                'new_status'      => 'clean',
                'reason'          => $validated['alasan_override'],
                'file'            => $laporan->bukti_poc,
            ],
            request: $request,
        );

        Log::warning('AUDIT TRAIL — Karantina PoC Di-override oleh Analis', [
            'admin_id'   => $request->user()?->id,
            'laporan_id' => $laporan->id,
            'file'       => $laporan->bukti_poc,
            'reason'     => $validated['alasan_override'],
            'ip_address' => $request->ip(),
        ]);

        return back()->with('pesan', 'Karantina file PoC berhasil di-override menjadi Clean. Akses unduh telah dibuka.');
    }

    /**
     * Forward a report to an OPD (Organisasi Perangkat Daerah) with an embargo date.
     * Dispatches a DISPOSITION_SENT audit log entry.
     *
     * Gate: LaporanPolicy::update() — admin only via before() hook.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function disposition(Request $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('update', $laporan);

        $validated = $request->validate([
            'opd_target'    => ['required', 'string', 'max:120'],
            'embargo_date'  => ['required', 'date', 'after_or_equal:today'],
            'catatan'       => ['nullable', 'string', 'max:500'],
        ]);

        LaporanActivityLog::record(
            laporan: $laporan,
            causer:  $request->user(),
            action:  'DISPOSITION_SENT',
            details: [
                'opd_target'   => $validated['opd_target'],
                'embargo_date' => $validated['embargo_date'],
                'catatan'      => $validated['catatan'] ?? null,
            ],
            request: $request,
        );

        Log::info('AUDIT TRAIL — Disposisi OPD Dikirim', [
            'admin_id'     => $request->user()?->id,
            'laporan_id'   => $laporan->id,
            'opd_target'   => $validated['opd_target'],
            'embargo_date' => $validated['embargo_date'],
            'ip_address'   => $request->ip(),
        ]);

        return back()->with('pesan', "Laporan berhasil diteruskan ke {$validated['opd_target']} dengan embargo {$validated['embargo_date']}.");
    }

    /**
     * Print-friendly view of an official single-vulnerability advisory (Diskominfo Jatim format).
     * Gate: LaporanPolicy::view() — admin only via before() hook.
     *
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function cetakAdvisory(Laporan $laporan): View
    {
        Gate::authorize('view', $laporan);

        $laporan->load(['user', 'activityLogs' => function ($query) {
            $query->with('causer')->latest('created_at');
        }]);

        return view('admin-laporan-advisory-cetak', compact('laporan'));
    }

    /**
     * Print-friendly view of all reports.
     * Gate: LaporanPolicy::viewAny() — admin only via before() hook.
     */
    public function cetak(): View
    {
        Gate::authorize('viewAny', Laporan::class);

        $laporans = Laporan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-laporan-cetak', compact('laporans'));
    }
}
