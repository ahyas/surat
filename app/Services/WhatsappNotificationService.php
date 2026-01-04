<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappNotificationService
{
    public function send(string $target, string $message): bool
    {
        $token = env('FONNTE_TOKEN');
        $endpoint = env('FONNTE_ENDPOINT', 'https://api.fonnte.com/send');

        if (empty($token)) {
            Log::warning('Fonnte token not configured, WA notification skipped');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post($endpoint, [
                'target' => $target,
                'message' => $message,
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('Fonnte send failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Fonnte send exception', ['error' => $e->getMessage()]);
        }

        return false;
    }
}
