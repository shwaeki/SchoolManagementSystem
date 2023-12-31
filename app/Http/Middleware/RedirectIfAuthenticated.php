<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if (Auth::guard('parent')->check()) {
            return redirect()->route('parents.index');
        }

        if (Auth::guard('web')->check() || Auth::guard('teacher')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }


        return $next($request);
    }
}
