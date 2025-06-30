<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(uniqid()), // Random password, since not used
            ]
        );


        if ($user->wasRecentlyCreated) {
            $user->assignRole('user'); // أو 'student' حسب ما سميته في roles
        }

        Auth::login($user, true);

        // return redirect()->intended('/dashboard');

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('instructor')) {
            return redirect('/instructor/dashboard');
        } else {
            return redirect('/user/dashboard');
        }
    }
}
