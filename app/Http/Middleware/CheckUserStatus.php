<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check()){
            if (Auth::user()->status !== 'aktif'){
                Auth::logout();

                return redirect()->route('login')
                ->with('error', 'Akun Anda tidak aktif. Silahkan hubungi Admin.');
            }
        }
        return $next($request);
    }
}
