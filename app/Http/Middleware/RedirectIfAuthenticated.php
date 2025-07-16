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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Si la HOME est /login, on ne redirige pas vers /login si l'utilisateur est déjà connecté
                if (RouteServiceProvider::HOME === '/login') {
                    // Rediriger vers une autre page comme /dashboard
                    return redirect('/home');
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}

