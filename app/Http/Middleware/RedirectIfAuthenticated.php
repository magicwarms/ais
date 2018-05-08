<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        switch ($guard) {
            case 'teacher':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('berandas');
            }
            break;
            case 'parent':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('parents');
            }
            break;
            case 'student':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('front');
            }
            break;
            default:
            if (Auth::guard($guard)->check()) {
                  return redirect('/beranda');
            }
            break;
        }
        
        return $next($request);
    }
}
