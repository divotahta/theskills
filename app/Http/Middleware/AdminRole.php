<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Lakukan pemeriksaan apakah pengguna saat ini adalah admin dengan tipe yang sesuai
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
        return response()->json(['You dont have permission to acces this page']);
        
    }
}
