<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToRoleDashboard
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        if ($request->is('dashboard')) {
            // Redirect to the appropriate dashboard based on role
            if ($user->hasRole('admin')) {
                return redirect('/admin/dashboard');
            } elseif ($user->hasRole('instructor')) {
                return redirect('/instructor/dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect('/user/dashboard');
            }
        }

        return $next($request);
    }
}

