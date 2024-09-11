<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-32 mb-3">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
    </div>

    <h4>Hello! let's get started</h4>
    <h6 class="text-gray-700">Sign in to continue as Parent.</h6>

    <!-- Login for Parent` -->
    <form method="POST" action="{{ route('parent.loginCheck') }}" class="mt-3">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full items-center justify-center mt-4 text-white dark:text-white">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <x-primary-button class="w-full items-center justify-center mt-2 text-white dark:text-white">
        <a href="{{ route('/') }}">
        Home Page
        </a>
    </x-primary-button>
</x-guest-layout>
