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
        <link href="/css/vuetify.min.css" rel="stylesheet">
        
        <link href="/css/app_main.css" rel="stylesheet">
       

        @yield('cssFile')
    </head>
    <body>
    
    <style>
        body{
            background-color : var(--main-content-bg);
        }
            
    </style>
    <div class="navbar-fixed   ">
        <nav class="nav-main white elevation-2">

            <div class="nav-main-wrapper">
                <section class="nav-main-col">
                        @if(Session::has("userType") && Session::get("userType") === "admin" ) 
                        <i aria-hidden="true" id="mainNavBtnMenu" class="material-icons main-nav__btnMenu">menu</i>   
                    @endif
                     <a href="/">
                            <img class="main-nav__logo" src="/img/logo.png" alt="">
                        </a>
                </section>

               
            </div>

            
            </nav>
      </div>
    

       @if(Session::has("userType") && Session::get("userType") === "admin" ) 
           @include('admins/layouts.menu_aside') 
       @endif


       <main id="main-app-content" class="main-app-content">
            @yield('content')
        </main>

        
       
        @if(Session::has("userType") && Session::get("userType") === "admin" ) 
              <script src="/js/app.js"></script>

            
       @endif

       

         
       @yield('scripts')
    </body>
</html>