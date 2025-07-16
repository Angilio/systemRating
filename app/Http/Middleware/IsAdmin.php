<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ajoute ça

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('Admin')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Accès réservé aux administrateurs.');
    }
}
