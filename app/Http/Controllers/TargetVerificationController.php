<?php

namespace App\Http\Controllers;

use App\Services\Security\TargetVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * TargetVerificationController
 *
 * Exposes the Anti-SSRF TargetVerificationService as a rate-limited
 * web endpoint consumed by the hunter submission form's JS checker.
 *
 * Security measures:
 *   - CSRF protected (web middleware / @csrf meta header)
 *   - Rate limited at 15 requests per minute per IP (throttle:15,1)
 *   - Input validated: url required, max 255 characters
 *   - All network I/O delegated to TargetVerificationService; this
 *     controller never touches raw DNS or HTTP itself.
 */
class TargetVerificationController extends Controller
{
    public function __construct(
        private readonly TargetVerificationService $verifier,
    ) {}

    /**
     * Verify a hunter-submitted target URL for scope and liveness.
     *
     * POST /api/verify-target
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function verify(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'url' => ['required', 'string', 'url', 'max:255'],
        ]);

        $result = $this->verifier->verify($validated['url']);

        /** @var int $httpStatus */
        $httpStatus = match ($result['status']) {
            'verified'          => 200,
            'out_of_scope'      => 422,
            'offline'           => 200,    // Surface to the UI, not a server error
            'dns_failure'       => 200,    // Same
            'prohibited_target' => 403,
            default             => 422,
        };

        return response()->json($result, $httpStatus);
    }
}
