<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationAutoLoginController extends Controller
{
    public function login(Request $request, User $user)
    {
        if ($this->isInactiveUser($user->id)) {
            abort(403, 'User tidak aktif.');
        }

        $redirectTo = $this->validatedRedirect((string) $request->query('redirect', ''));
        $guard = config('auth.defaults.guard', 'web');

        if (!Auth::guard($guard)->check() || Auth::guard($guard)->id() !== $user->id) {
            Auth::guard($guard)->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Auth::guard($guard)->login($user);
            $request->session()->regenerate();
        }

        return redirect()->to($redirectTo);
    }

    private function isInactiveUser($userId): bool
    {
        $status = DB::table('daftar_pegawai')
            ->where('id_user', $userId)
            ->value('status');

        return $status !== null && (int) $status !== 1;
    }

    private function validatedRedirect(string $redirect): string
    {
        if ($redirect === '') {
            return route('home');
        }

        if (strpos($redirect, '/') === 0 && strpos($redirect, '//') !== 0) {
            return $redirect;
        }

        $appUrl = rtrim(config('app.url'), '/');
        $appHost = parse_url($appUrl, PHP_URL_HOST);
        $appScheme = parse_url($appUrl, PHP_URL_SCHEME);
        $redirectHost = parse_url($redirect, PHP_URL_HOST);
        $redirectScheme = parse_url($redirect, PHP_URL_SCHEME);

        if ($redirectHost === $appHost && $redirectScheme === $appScheme) {
            return $redirect;
        }

        return route('home');
    }
}
