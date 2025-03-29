<!doctype html>
<html lang="en">
@include('layouts.meta')

<head>
    @vite(['resources/sass/app.scss'])
    @livewireStyles

    <style>
        .navigation .navigation-menu-tab ul li, .navigation .navigation-menu-tab   {
            background-color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li>a.active{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li.open>a{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li>a:hover{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }
    </style>

</head>

<body class="fixed">

    @include('layouts.header')

    <div id="main">

        <div class="navigation">

            @include('layouts.left')

        </div>

        <div class="main-content" id="content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>

    </div>

    @include('layouts.alert')

    <script src="{{ url('assets/js/app.min.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    @stack('footer')

    @livewireScripts

    <script>
    Pusher.logToConsole = {{ env('APP_DEBUG') ? 'true' : 'false' }};

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        authEndpoint: '{{ url('/broadcasting/auth') }}'
    });

    var channel = pusher.subscribe('private-broadcast');
    channel.bind('bell', function(data) {
        window.Livewire.dispatch('bell');
    });
    </script>

</body>

</html>

