<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $pesanUser = $validated['message'];
        $panduanCSIRT = KnowledgeBase::getInfo();

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('services.groq.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => config('services.groq.model'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "Anda adalah Asisten AI resmi JatimProv-CSIRT. Jawablah pertanyaan user HANYA berdasarkan DATA BERIKUT:\n\n".$panduanCSIRT."\n\nATURAN PENTING:\n1. Basa-basi/Sapaan: Jika pengguna hanya menyapa (contoh: hi, halo, p, assalamualaikum, pagi), JANGAN ditolak. Balaslah sapaannya dengan ramah dan tawarkan bantuan terkait layanan CSIRT.\n2. Typo: Pengguna mungkin salah ketik. Tebak maksudnya sebelum menjawab.\n3. Luar Topik: HANYA tolak dan arahkan ke menu Kontak jika pertanyaan benar-benar melenceng jauh dari keamanan siber dan BUKAN sebuah sapaan.",
                    ],
                    [
                        'role' => 'user',
                        'content' => $pesanUser,
                    ],
                ],
                'temperature' => 0.4,
            ]);

            if ($response->successful()) {
                return response()->json(['reply' => $response->json()['choices'][0]['message']['content']]);
            }

            Log::warning('Chatbot Groq API returned non-successful response', [
                'status' => $response->status(),
            ]);

            return response()->json(['reply' => 'Maaf, server AI sedang sibuk. Silakan coba beberapa saat lagi.']);

        } catch (Exception $e) {
            Log::error('Chatbot Groq API request failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json(['reply' => 'Waduh, koneksi ke AI terputus.']);
        }
    }
}
