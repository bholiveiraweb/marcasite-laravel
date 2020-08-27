<!doctype html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
    <div id="app">
        <div class="d-flex" id="wrapper">

            @if (Auth::check())
                <!-- Sidebar -->
                <div class="border-right bg-white" id="sidebar-wrapper">
                    <div class="sidebar-heading"><span class="navbar-brand">{{__('app.name')}}</span></div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('customer.add') }}" class="list-group-item list-group-item-action">Cadastrar Cliente</a>
                        <a href="{{ route('customer.index') }}" class="list-group-item list-group-item-action">Listar Clientes</a>
                        <a href="{{ route('proposal.add') }}" class="list-group-item list-group-item-action">Nova Proposta</a>
                        <a href="{{ route('proposal.index') }}" class="list-group-item list-group-item-action">Listar Propostas</a>
                        <a href="{{ route('user.add') }}" class="list-group-item list-group-item-action">Cadastrar Usuário</a>
                    </div>
                </div>
                <!-- /#sidebar-wrapper -->
            @endif

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    @guest
                        <span class="navbar-brand">
                            {{ __('app.name') }}
                        </span>
                    @else
                        <a href="#" class="py-2 px-3" id="menu-toggle"><i class="fas fa-bars"></i></a>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    @endguest

                    <div class="ml-auto" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto d-flex flex-row">
                            <!-- Authentication Links -->
                            @guest
                                <!-- <li class="nav-item">
                                    <a class="nav-link px-2" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                                </li> -->
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link px-2" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>

                <main class="py-4">
                    @yield('content')
                </main>

            </div>
        </div>
    </div>

    @yield('scripts')
    <script src="{{ URL::asset('js/scripts.js') }}" defer></script>
</body>
</html>
