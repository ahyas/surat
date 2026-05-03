<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotGatewayService
{
    public function validateMagicToken(string $token): array
    {
        $validateUrl = config('chatbot.validate_url');
        $internalApiKey = config('chatbot.internal_api_key');
        $applicationCode = config('chatbot.application_code', 'simisol');

        if (!$validateUrl || !$internalApiKey) {
            $this->logInvalid($token, 'missing_config');

            return ['valid' => false, 'reason' => 'missing_config'];
        }

        try {
            $response = Http::timeout(5)
                ->asForm()
                ->withHeaders([
                    'X-INTERNAL-API-KEY' => $internalApiKey,
                    'Accept' => 'application/json',
                ])
                ->post($validateUrl, [
                    'token' => $token,
                    'application_code' => $applicationCode,
                ]);
        } catch (\Throwable $e) {
            $this->logInvalid($token, 'gateway_exception', [
                'exception' => get_class($e),
            ]);

            return ['valid' => false, 'reason' => 'gateway_exception'];
        }

        if (!$response->successful()) {
            $this->logInvalid($token, 'gateway_http_error', [
                'status' => $response->status(),
            ]);

            return ['valid' => false, 'reason' => 'gateway_http_error'];
        }

        $data = $response->json() ?: [];
        $appUserId = $this->extractAppUserId($data);
        $isValid = $this->isValidResponse($data);

        if (!$isValid || empty($appUserId)) {
            $this->logInvalid($token, 'gateway_invalid_payload', [
                'valid_flag' => $isValid,
                'has_app_user_id' => !empty($appUserId),
                'response_keys' => array_keys($data),
                'data_keys' => is_array(data_get($data, 'data')) ? array_keys(data_get($data, 'data')) : [],
            ]);

            return ['valid' => false, 'reason' => 'gateway_invalid_payload'];
        }

        Log::info('Chatbot magic login validation succeeded', [
            'token_hash' => substr(hash('sha256', $token), 0, 16),
            'app_user_id_hash' => substr(hash('sha256', (string) $appUserId), 0, 16),
            'app_user_id_length' => strlen((string) $appUserId),
            'app_user_id_is_numeric' => is_numeric((string) $appUserId),
        ]);

        return [
            'valid' => true,
            'app_user_id' => (string) $appUserId,
        ];
    }

    private function isValidResponse(array $data): bool
    {
        $valid = data_get($data, 'valid');
        $success = data_get($data, 'success');
        $status = strtolower((string) data_get($data, 'status', ''));

        return $valid === true
            || $valid === 1
            || $valid === '1'
            || strtolower((string) $valid) === 'true'
            || $success === true
            || $success === 1
            || $success === '1'
            || strtolower((string) $success) === 'true'
            || in_array($status, ['valid', 'success', 'ok'], true);
    }

    private function extractAppUserId(array $data)
    {
        $paths = [
            'app_user_id',
            'data.app_user_id',
            'user.app_user_id',
            'data.user.app_user_id',
            'employee_id',
            'data.employee_id',
            'employee.id',
            'data.employee.id',
            'employee.app_user_id',
            'data.employee.app_user_id',
            'user_id',
            'data.user_id',
            'id',
            'data.id',
            'nip',
            'data.nip',
            'user.nip',
            'data.user.nip',
            'employee.nip',
            'data.employee.nip',
            'email',
            'data.email',
        ];

        foreach ($paths as $path) {
            $value = data_get($data, $path);

            if (!empty($value)) {
                return $value;
            }
        }

        return null;
    }

    private function logInvalid(string $token, string $reason, array $context = []): void
    {
        Log::warning('Chatbot magic login validation failed', array_merge([
            'reason' => $reason,
            'token_hash' => substr(hash('sha256', $token), 0, 16),
        ], $context));
    }
}
