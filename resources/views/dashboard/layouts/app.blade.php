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
            <h4>Dasboard</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    @can('viewAny', "App\\Models\Tag")
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('tags.index') }}">Tags</a></li>
                    </ul>
                    @endcan
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