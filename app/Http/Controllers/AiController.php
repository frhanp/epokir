<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AiController extends Controller
{
    public function ask(Request $request)
    {
        // 1. Cek API Key
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'API Key tidak terbaca di .env'
            ], 200); // Pakai 200 biar terbaca di PowerShell
        }

        // 2. Siapkan Data
        $question = $request->input('question', 'Tes koneksi');
        $schema = "Table: pokirs (kategori_usulan, opd_tujuan, anggota_dprd, spesifikasi, alamat, nama_pemohon, created_at)";
        $prompt = "You are a SQL assistant. Schema: $schema. Question: '$question'. Return ONLY raw SQL (SELECT).";

        try {
            // Ganti jadi 1.5-flash (lebih stabil & jarang kena limit 429)
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

            // 3. Kirim Request ke Google (Pakai withoutVerifying untuk bypass SSL issue di Windows/Laragon)
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ]
                ]);

            // ==========================================
            // 🛑 DEBUGGING MODE (Return JSON)
            // ==========================================
            return response()->json([
                'DEBUG_STATUS' => $response->successful() ? 'SUCCESS' : 'FAILED',
                'HTTP_CODE' => $response->status(),
                'API_KEY_PARTIAL' => substr($apiKey, 0, 8) . '...',
                'GOOGLE_RESPONSE' => $response->json(),
            ]);

            // Kode di bawah ini unreachable selama return di atas masih aktif
            /*
            if ($response->failed()) { ... }
            $data = $response->json();
            ...
            */
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'CRITICAL ERROR',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 200);
        }
    }
}
