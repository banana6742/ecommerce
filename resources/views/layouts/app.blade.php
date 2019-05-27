    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            @include('includes.navbar')  
            <div class="container py-4">
                @if($errors->count()>0)
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                @yield('content')
            </div>
        </div>

        {{-- script --}}
        <script src="/js/app.js"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script>
        
            @if(Session::has('success'))
                toastr.info("{{ Session::get('success') }}")
            @endif

            @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}")
            @endif

        </script>
    </body>
    </html>
