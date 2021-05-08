<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}" />

        <title>{{$title.' | '.env('APP_NAME')}}</title>

        @include('layout.css')
        @livewireStyles
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('layout.nav')
            @include('layout.sidebar')

            <div class="content-wrapper">
                @include('layout.header')
                <div class="content">
                    @include('layout.alert')
                    @yield('content')
                </div>
                <div wire:loading>Processing...</div>
            </div>
            @include('layout.footer')
        </div>

        @include('layout.js')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
        </script>
        <x-livewire-alert::scripts />
    </body>
</html>
