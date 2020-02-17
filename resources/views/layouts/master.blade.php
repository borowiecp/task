
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
    <link href="/css/own.css" rel="stylesheet">

    @auth
        <meta name="csrf-token" content="{{ csrf_token() }}">    
    @endauth

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <script src="/js/app.js"></script>
  </head>
  <body>
    <div class="page">
        <div class="container">
            @include('layouts.header')
            @include('layouts.navbar')
    
            <div class="main-content mt-3">
                @yield('content')
            </div>
        </div>
    
        @include('layouts.footer')
    </div>
</body>
</html>
