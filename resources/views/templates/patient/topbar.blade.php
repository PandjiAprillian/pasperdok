<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i> <a href="mailto:pasperdok@business.com">pasperdok@business.com</a>
            <i class="icofont-phone"></i> +6289696961232
            <i class="icofont-google-map"></i> Jl. Cemerlang No.8, Sukakarya
        </div>
        <div>
        </div>
        <div class="social-links">
            <a href="https://github.com/PandjiAprillian" target="blank" class="github"><i
                    class="icofont-github"></i></a>
            <a href="https://www.facebook.com/PandjiAprilian/" target="blank" class="facebook"><i
                    class="icofont-facebook"></i></a>
            <a href="https://www.instagram.com/pandjiaprillian/" target="blank" class="instagram"><i
                    class="icofont-instagram"></i></a>
            <a href="https://pandjiaprillian.github.io/" target="blank" class="world"><i class="icofont-world"></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="#">PasPerDok</a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ request()->is('/') ? '#hero' : '/' }}">Home</a>
                </li>
                {{-- @auth
                <li><a href="{{ url('/post') }}">Post</a></li>
                @endauth --}}
                <li>
                    <a href="{{ request()->is('/') ? '#about' : '/#about' }}">About</a>
                </li>
                <li>
                    <a href="{{ request()->is('/') ? '#services' : '/#services' }}">Services</a>
                </li>
                <li>
                    <a href="{{ request()->is('/') ? '#contact' : '/#contact' }}">Location</a>
                </li>
                @guest
                <li class="drop-down"><a href="" onclick="event.preventDefault();">SignIn / SignUp</a>
                    <ul>
                        @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nama }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->hasRole('patient'))
                        <a href="{{ route('patients.show', ['patient' => Auth::user()->patient->id ?? 1]) }}"
                            class="dropdown-item px-3">Profile</a>
                        @elseif (Auth::user()->hasRole('nurse'))
                        <a href="{{ route('nurses.index') }}"
                            class="dropdown-item px-3">Home</a>
                        @elseif (Auth::user()->hasRole('doctor'))
                        <a href="{{ route('doctors.index') }}"
                            class="dropdown-item px-3">Home</a>
                        @elseif (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admins.index') }}"
                            class="dropdown-item px-3">Home</a>
                        @endif
                        <a class="dropdown-item px-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest


            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
