{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @auth
        @if (Auth::user()->user_role == 'admin')
            @include('dashboard.admin-dashboard')
        @elseif(Auth::user()->user_role == 'educator')
            @include('dashboard.educator-dashboard')
        @elseif(Auth::user()->user_role == 'student')
            @include('dashboard.student-dashboard')
        @endif
    @endauth

    @guest
        @include('dashboard.guest-dashboard')
    @endguest
</x-app-layout> --}}



@auth
    @if (Auth::user()->user_role == 'admin')
        @include('dashboard.admin-dashboard')
    @elseif(Auth::user()->user_role == 'educator')
        @include('dashboard.educator-dashboard')
    @elseif(Auth::user()->user_role == 'parent')
        @include('dashboard.parent-dashboard')
    @elseif(Auth::user()->user_role == 'student')
        @include('dashboard.student-dashboard')
    @endif
@endauth

@guest
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        @include('dashboard.guest-dashboard')
    </x-app-layout>
@endguest

<script>
    function startCamera() {
        const video = document.getElementById("video");
        const wea_status = document.getElementById("weather_status");

        wea_status.style.visibility = 'hidden';
        video.style.visibility = 'visible';
        video.style.width = '100%';
        video.style.height = '100%';


        // Create a new instance of Instascan
        const scanner = new Instascan.Scanner({
            video: document.getElementById('video')
        });

        // Function to handle successful QR code scan
        function handleQRCodeScan(result) {
            console.log('QR code scanned:', result);

            // Extract the URL from the scanned data
            const url = result;

            // Redirect to the scanned URL
            window.location.href = url;
        }

        // Add a listener for the scan event
        scanner.addListener('scan', handleQRCodeScan);

        // Start the scanner
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(error) {
            console.error('Error accessing camera:', error);
        });
    }
</script>
