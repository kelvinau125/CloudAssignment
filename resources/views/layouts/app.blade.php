<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Custom Template -->
         <!-- plugins:css -->
         <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }} ">
        <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- <link rel="stylesheet" href="css/vertical-layout-light/style.css"> -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @auth
                @include('layouts.navigation')
            @endauth

            {{-- @yield('content') --}}
            
            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Custom Javascripts -->
         <!-- plugins:js -->
        <script src=" {{ asset('vendors/js/vendor.bundle.base.js') }} "></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src=" {{ asset('vendors/chart.js/Chart.min.js') }} "></script>
        <script src=" {{ asset('vendors/datatables.net/jquery.dataTables.js') }} "></script>
        <script src=" {{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }} "></script>
        <script src="{{ asset('js/dataTables.select.min.js') }} "></script>

        <!-- Include SweetAlert2 library -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('js/off-canvas.js') }} "></script>
        <script src="{{ asset('js/hoverable-collapse.js') }} "></script>
        <script src="{{ asset('js/template.js') }} "></script>
        <script src="{{ asset('js/settings.js') }} "></script>
        <script src="{{ asset('js/todolist.js') }} "></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('js/dashboard.js') }} "></script>
        <script src="{{ asset('js/Chart.roundedBarCharts.js') }} "></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript">
        <!-- End custom js for this page-->
    </body>
</html>
