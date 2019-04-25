<html>
    <head>
        <title>
            @section('title')
            @show
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <link href="/css/app_main.css" rel="stylesheet">
        @yield('cssFile')
    </head>
    <body>
      <div class="navbar-fixed">
        <nav class="main-nav elevation-2">

            <div class="main-nav__content">
            @if(Session::has("userType") && Session::get("userType") === "admin" ) 
                <i aria-hidden="true" id="mainNavBtnMenu" class="material-icons main-nav__btnMenu">menu</i>   
            @endif
                <img class="main-nav__logo" src="/img/logo.png" alt="">
            </div>
            </nav>
      </div>
    

       @if(Session::has("userType") && Session::get("userType") === "admin" ) 
           @include('students/layouts.menu_aside') 
       @endif


        <main>
            @yield('content')
        </main>

        
       
        @if(Session::has("userType") && Session::get("userType") === "admin" ) 
              <script src="/js/app.js"></script>
       @endif
       @yield('scripts')
    </body>
</html>