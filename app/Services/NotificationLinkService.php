<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
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

    public function replaceInternalLinksForPhone($phone, string $message, $fallbackUserId = null): string
    {
        $userId = $this->findUserIdByPhone($phone) ?: $fallbackUserId;

        return $this->replaceInternalLinks($userId, $message);
    }

    private function shouldWrap(string $url): bool
    {
        $base = rtrim(config('app.url'), '/');

        if ($base === '') {
            return false;
        }

        if (!$this->isInternalUrl($url, $base)) {
            return false;
        }

        return strpos(parse_url($url, PHP_URL_PATH) ?: '', '/notification/autologin') !== 0;
    }

    private function isInternalUrl(string $url, string $base): bool
    {
        $urlHost = $this->normalizeHost((string) parse_url($url, PHP_URL_HOST));
        $baseHost = $this->normalizeHost((string) parse_url($base, PHP_URL_HOST));
        $urlScheme = parse_url($url, PHP_URL_SCHEME);
        $baseScheme = parse_url($base, PHP_URL_SCHEME);

        return $urlHost !== ''
            && $urlHost === $baseHost
            && $urlScheme === $baseScheme;
    }

    private function findUserIdByPhone($phone)
    {
        $normalizedPhone = $this->normalizePhone($phone);

        if ($normalizedPhone === '') {
            return null;
        }

        try {
            $rows = DB::table('daftar_pegawai')
                ->select('id_user', 'no_wa')
                ->whereNotNull('no_wa')
                ->where('status', 1)
                ->get();
        } catch (\Throwable $e) {
            return null;
        }

        foreach ($rows as $row) {
            if ($this->normalizePhone($row->no_wa) === $normalizedPhone) {
                return $row->id_user;
            }
        }

        return null;
    }

    private function normalizePhone($phone): string
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);

        if ($digits === '') {
            return '';
        }

        if (strpos($digits, '0') === 0) {
            return '62'.substr($digits, 1);
        }

        if (strpos($digits, '8') === 0) {
            return '62'.$digits;
        }

        return $digits;
    }

    private function normalizeHost(string $host): string
    {
        $host = strtolower($host);

        return strpos($host, 'www.') === 0 ? substr($host, 4) : $host;
    }

    private function expirationMinutes(): int
    {
        $minutes = (int) env('WA_AUTOLOGIN_LINK_MINUTES', 525600);

        return $minutes > 0 ? $minutes : 525600;
    }
}
