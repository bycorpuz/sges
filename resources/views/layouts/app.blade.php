<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supreme Pupil/Student Government Election System</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="/css/fonts.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type='text/javascript' src='/js/jquery.js'></script>
    <link rel="stylesheet" href="/css/w3.css">

    @yield('headers')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Supreme Pupil/Student Government Election System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if(session('user'))
                            @if(session('access_level')->isAdmin())
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        School Info<span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('update_school_info') }}">Update School Info</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Comelec Account<span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user_comelec_list') }}">Comelec Account List</a>
                                        {{-- <a class="dropdown-item" href="{{ route('user_comelec_add') }}">Create Comelec Account</a> --}}
                                    </div>
                                </li>

                                    <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        System<span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('system_reset') }}" onclick='return confirm("This will DELETE all your election data. Are you sure want to reset the election System?")'>Reset</a>
                                    </div>
                                </li>
                            @elseif(session('access_level')->isComelec())

                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('party_list') }}">List of Parties</a>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('party_list') }}">List of Parties</a>
                                        {{-- <a class="dropdown-item" href="{{ route('party_add') }}">Add Party</a> --}}
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link" href="{{ route('candidate_list') }}">
                                        Candidates List<span class="caret"></span>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link" href="{{ route('voter_list') }}">Voters List</a>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('submitted') }}" target="_blank">List of Students Who Voted PDF</a>
                                        <a class="dropdown-item" href="{{ route('not_submitted') }}" target="_blank">List of Students Who Did Not Vote PDF</a>
                                    </div>
                                </li>

                                {{-- <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Position<span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('position_list') }}">Position List</a>
                                        <a class="dropdown-item" href="{{ route('position_add') }}">Add Position</a>
                                    </div>
                                </li> --}}
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ ucfirst(session('profile')->first_name) }} {{ ucfirst(session('profile')->middle_name) }} {{ ucfirst(session('profile')->last_name) }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(session('access_level')->isAdmin())
                                    <button onclick="open_modal('update_admin_profile');" class="dropdown-item">Update Profile</button>
									@else
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
