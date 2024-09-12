<x-guest-layout>
    <div class="w-32 mb-3">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
    </div>

      <h4>Hi, Parent?</h4>
      <h6 class="text-gray-700">Signing up is easy. It only takes a few steps</h6>

    <form method="POST" action="{{ route('register') }}" class="mt-3">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('parent.login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <x-primary-button class="w-full h-10 items-center justify-center mt-5 text-white dark:text-white">
            {{ __('Register') }}
        </x-primary-button>
    </form>

    <x-primary-button class="w-full h-10 items-center justify-center mt-2 text-white dark:text-white">
        <a href="{{ route('/') }}">
        Home Page PARENT
        </a>
    </x-primary-button>
</x-guest-layout>
