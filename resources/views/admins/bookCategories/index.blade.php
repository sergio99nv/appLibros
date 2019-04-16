<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">

    
    <title>Document</title>
</head>
 
<body>
    <div id="app">
         <router-view></router-view>

    </div>
    
    <script src="/js/admins/bookCategories/app.js"></script>
</body>
</html>