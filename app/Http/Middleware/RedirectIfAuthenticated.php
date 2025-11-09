<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Jika user sudah login, arahkan ke dashboard sesuai role.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if (in_array($user->role, ['hr', 'manager'])) {
                    return redirect()->route('dashboard.hr');
                }

                return redirect()->route('dashboard.karyawan');
            }
        }

        return $next($request);
    }
}
