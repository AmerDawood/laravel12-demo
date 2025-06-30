<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if (!$request->user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }

        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('instructor')) {
            return redirect('/instructor/dashboard');
        } else {
            return redirect('/user/dashboard');
        }
    }
}
