<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">

            @if(auth()->user()->role == 1) <?php $display_nav = ""; ?>
            @else <?php $display_nav = "display:none;"; ?>
            @endif

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Podrška') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <ul class="nav navbar-nav">
            <li class="" style="{{$display_nav}}"><a href="/companies">Preduzeća</a></li>
                <li style="{{$display_nav}}"><a href="/users">Korisnici</a></li>
                <li style="{{$display_nav}}" class="dropdown">
                    <a style="{{$display_nav}}" class="dropdown-toggle" data-toggle="dropdown" href="#">Šifarnici
                    <span style="{{$display_nav}}" class="caret"></span></a>
                    <ul style="{{$display_nav}}" class="dropdown-menu">
                        <li><a href="/users_type">Tip korisnika</a></li>
                        <li><a href="/tasks_type">Tip zahtjeva</a></li>
                        <li><a href="/model_create_tasks">Način kreiranja zahtjeva</a></li>
                        <li><a href="/statuses">Status</a></li>
                        <li><a href="/responsible_users">Odgovorna osoba</a></li>
                        <li><a href="/applications">Aplikacija</a></li>
                    </ul>
                </li>
                <li><a href="/tasks">Zahtjevi</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Odjavi se
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>