<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <!-- Check if the logged-in user is an educator -->
    @if (Auth::user()->user_role == 'educator')
        <div class="container-fluid page-body-wrapper">
            @include('educator.educatorSideBar') <!-- Educator-specific sidebar -->
            <div class="py-12 w-full">
                <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        @elseif (Auth::user()->user_role == 'student')
        <div class="container-fluid page-body-wrapper">
            @include('student.module.studentSideBar') <!-- Educator-specific sidebar -->
            <div class="py-12 w-full">
                <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    @else
         <!-- For other users -->
         <div class="container-fluid page-body-wrapper">
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>