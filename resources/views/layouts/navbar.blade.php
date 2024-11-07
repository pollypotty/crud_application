<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            {{--            app name with link to home page--}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            {{--            hamburger button--}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                {{--                right side of navbar--}}
                <ul class="navbar-nav ms-auto">

                    {{--                    authentication links--}}
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                        {{--                                                links for authenticated users--}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">{{ __('Companies') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employees.index') }}">{{ __('Employees') }}</a>
                        </li>

                        {{--                                            dropdown with authenticated user's name and logout button--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            {{--                                                        logout--}}
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                    {{--                                        language picker--}}
                    <li class="nav-item">
                        <div>
                            <a class="nav-link" href="{{ route('language.switch', 'hu') }}">
                                <img class=language-icon src="/images/hungary_round_icon_256.png" alt="Magyar">
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div>
                            <a class="nav-link" href="{{ route('language.switch', 'en') }}">
                                <img class="language-icon" src="/images/united_kingdom_round_icon_256.png"
                                     alt="English">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
