<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // ✅ Jika belum login
        if (!Auth::check()) {
            abort(401, 'Silakan login terlebih dahulu');
        }

        // ✅ Cek role
        if (Auth::user()->role !== $role) {
            abort(403, 'Anda tidak memiliki akses');
        }

        return $next($request);
    }
}
