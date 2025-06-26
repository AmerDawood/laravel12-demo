<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-6">
            <a href="{{ route('google.login') }}"
               style="display: inline-flex; align-items: center; background: #fff; color: #444; border: 1px solid #ddd; border-radius: 4px; padding: 8px 16px; font-weight: 500; font-size: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-decoration: none; transition: background 0.2s; gap: 8px;"
               onmouseover="this.style.background='#f7f7f7'" onmouseout="this.style.background='#fff'">
                <svg width="20" height="20" viewBox="0 0 48 48" style="margin-right:8px;"><g><path fill="#4285F4" d="M24 9.5c3.54 0 6.7 1.22 9.19 3.23l6.85-6.85C35.64 2.36 30.13 0 24 0 14.82 0 6.73 5.8 2.69 14.09l7.99 6.2C12.36 13.98 17.73 9.5 24 9.5z"/><path fill="#34A853" d="M46.1 24.55c0-1.64-.15-3.22-.42-4.74H24v9.01h12.42c-.54 2.9-2.18 5.36-4.65 7.01l7.19 5.59C43.99 37.09 46.1 31.3 46.1 24.55z"/><path fill="#FBBC05" d="M10.68 28.29c-1.13-3.36-1.13-6.97 0-10.33l-7.99-6.2C.99 16.09 0 19.92 0 24c0 4.08.99 7.91 2.69 12.24l7.99-6.2z"/><path fill="#EA4335" d="M24 48c6.13 0 11.64-2.03 15.54-5.53l-7.19-5.59c-2.01 1.35-4.59 2.16-7.35 2.16-6.27 0-11.64-4.48-13.32-10.47l-7.99 6.2C6.73 42.2 14.82 48 24 48z"/><path fill="none" d="M0 0h48v48H0z"/></g></svg>
                Sign in with Google
            </a>
        </div>
    </form>
</x-guest-layout>
