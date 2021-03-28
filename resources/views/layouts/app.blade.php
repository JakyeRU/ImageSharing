<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ asset('icon.svg') }}">
        <link href="{{ asset('css/filepond.css') }}" rel="stylesheet">
        <style>[x-cloak] {display: none}</style>

        <!-- Scripts -->
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/filepond-plugin-file-validate-type.js')}}"></script>
        <script src="{{asset('js/filepond.js')}}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Error/Success -->
            @if (session() -> has('success') || session() -> has('error'))
                <div class="container mx-auto px-4 pt-4">
                    <div class="bg-{{session() -> has('success') ? 'green' : 'red'}}-100 border border-{{session() -> has('success') ? 'green' : 'red'}}-400 text-{{session() -> has('success') ? 'green' : 'red'}}-700 px-4 py-3 rounded relative text-center" role="alert">
                        {{-- <strong class="font-bold">Error!</strong> --}}
                        <span class="block sm:inline">{{session() -> has('success') ? session() -> get('success') : session() -> get('error')}}</span>
                    </div>
                </div>
            @endif

            <!-- Email Notice -->
            @if (!auth() -> user() -> hasVerifiedEmail())
                <div class="container mx-auto px-4 pt-4">
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative text-center" role="alert">
                        {{-- <strong class="font-bold">Error!</strong> --}}
                        <span class="block sm:inline">Please confirm your email <strong>{{auth() -> user() -> email}}</strong> to start uploading. <strong><u><a href="{{route('verification.notice')}}">Email not received?</a></u></strong></span>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="{{asset('js/feather.min.js')}}"></script>
        <!-- Scripts -->
        @yield('scripts')
    </body>
</html>
