<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        return abort(403, 'Unauthorized.');
    }*/

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return redirect('login'); // Redirect if user is not logged in
        }

        // Log the user's role for debugging
        // Log::info('User Role: ' . $user->role);

        // Check if the user's role is one of the allowed roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized action.'); // Unauthorized if user role does not match
        }

        return $next($request);
    }
}
