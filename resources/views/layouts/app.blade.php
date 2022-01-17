<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    @yield('livewireStyles')
    @yield('includes')
    
</head>

<body>
    <div class="container-fluid">

        <div class="row justify-content-center">

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('posts.index') ? 'active' : '' }}" href="{{ route('posts.index') }}">Blog</a>
                      </li>

                      @guest
                      @if (Route::has('login'))
                      <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      @endif
                      @endguest

                      @auth
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          More actions
                        </a>
                        @can('modify', \App\Models\Tag::class)
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>
                        @endcan
                      </li>
                      @endauth
                      
                      

                    </ul>
                  </div>
                </div>
              </nav>

            {{-- <div class="col">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                          </li>
                        </ul>
                        </div>
                </div>
            </div> --}}
        </div>

        @yield('content')
</div>


    @yield('livewireScripts')
    @yield('script')

</body>




</html>
