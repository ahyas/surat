<?php

return [
    'validate_url' => env('CHATBOT_GATEWAY_VALIDATE_URL', 'https://bot.pta-papuabarat.go.id/api/magic-login/validate'),
    'internal_api_key' => env('CHATBOT_GATEWAY_INTERNAL_API_KEY'),
    'application_code' => env('CHATBOT_APPLICATION_CODE', 'simisol'),
    'autologin_error_message' => env(
        'CHATBOT_AUTOLOGIN_ERROR_MESSAGE',
        'Link login tidak valid atau sudah kedaluwarsa. Silakan minta link baru melalui chatbot.'
    ),
];
