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
</head>
<body id="dashboard">
    <div class="container-fluid">      
        <div class="row justify-content-center m-2">
            <a href="{{ route('dashboard') }}" class="dashboard-link"><h4>Dashboard</h4></a>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Back to blog</a></li>
                    </ul>
                    @can('viewAny', "App\\Models\Tag")
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('tags.index') }}">Tags</a></li>
                    </ul>
                    @endcan
                    @can('viewAny', "App\\Models\User")
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                    @endcan
                    @can('viewAny', "App\\Models\User")
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('user_settings.index') }}">User settings</a></li>
                    </ul>
                    @endcan
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="col-8">
                    @yield('content')
                </div>
                <div class="col-2"></div>
            </div>
    </div>
</body>
<script>
    function toggleTagOptions() {
      var x = document.getElementById("tag-options");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>
</html>