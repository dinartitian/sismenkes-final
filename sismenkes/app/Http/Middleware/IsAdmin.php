<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Memastikan bahwa yang login adalah admin, yang menggunakan guard 'web'
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman lain (misalnya ke dashboard)
        return redirect('/')->with('error', 'Anda tidak memiliki akses admin');
    }
}
