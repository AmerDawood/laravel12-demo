<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorSetup
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Skip if user is not authenticated
        if (!$user) {
            return $next($request);
        }

        // Skip if user already has 2FA enabled
        if ($user->two_factor_secret) {
            // Clear the session flag if user has 2FA
            session()->forget('needs_2fa_setup');
            return $next($request);
        }

        // Check session flag for immediate redirect after login
        if (session('needs_2fa_setup')) {
            session()->forget('needs_2fa_setup');
            return redirect()->route('profile.edit')
                ->with('message', 'يرجى تفعيل التحقق بخطوتين لحسابك.');
        }

        // Skip if user is already on 2FA setup pages
        if ($request->routeIs('two-factor.*') ||
            $request->routeIs('profile.*') ||
            $request->is('profile*') ||
            $request->is('two-factor*')) {
            return $next($request);
        }

        // Skip for logout and other auth routes
        if ($request->routeIs('logout') ||
            $request->routeIs('login') ||
            $request->routeIs('register')) {
            return $next($request);
        }

        // Redirect to 2FA setup page
        return redirect()->route('profile.edit')->with('message', 'يجب تفعيل التحقق بخطوتين لحسابك أولاً.');
    }
}