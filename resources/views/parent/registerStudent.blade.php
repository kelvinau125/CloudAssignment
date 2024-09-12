<x-guest-layout>
    <div class="w-32 mb-3">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
    </div>

      <h4>Hi, Parent?</h4>
      <h6 class="text-gray-700">Create Your Student Account</h6>

    <form method="POST" action="{{ route('registerStudent') }}" class="mt-3">
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
                            required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>



        <x-primary-button class="w-full h-10 items-center justify-center mt-5 text-white dark:text-white">
            {{ __('Register') }}
        </x-primary-button>
    </form>

</x-guest-layout>
