<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class NotificationLinkService
{
    public function makeForUser($userId, string $destination): string
    {
        if (empty($userId) || trim($destination) === '') {
            return $destination;
        }

        return URL::temporarySignedRoute(
            'notification.autologin',
            now()->addMinutes($this->expirationMinutes()),
            [
                'user' => $userId,
                'redirect' => $destination,
            ]
        );
    }

    public function replaceInternalLinks($userId, string $message): string
    {
        if (empty($userId) || trim($message) === '') {
            return $message;
        }

        return preg_replace_callback('/https?:\/\/[^\s]+/i', function ($matches) use ($userId) {
            $url = $matches[0];

            if (!$this->shouldWrap($url)) {
                return $url;
            }

            return $this->makeForUser($userId, $url);
        }, $message);
    }

    private function shouldWrap(string $url): bool
    {
        $base = rtrim(config('app.url'), '/');

        if ($base === '' || strpos($url, $base.'/') !== 0) {
            return false;
        }

        return strpos($url, $base.'/notification/autologin') !== 0;
    }

    private function expirationMinutes(): int
    {
        $minutes = (int) env('WA_AUTOLOGIN_LINK_MINUTES', 10080);

        return $minutes > 0 ? $minutes : 10080;
    }
}
