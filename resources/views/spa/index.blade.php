<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>

<h1>Hola</h1>
    <div id="app">
        <div>
        
        
        <router-link 
                
                :to="{  name: 'lection', 
                        params:{ 
                                'lectionId' : 0
                              
                            }
                        }">
                
                 
                lección
        </router-link>

        <keep-alive>
              <router-view></router-view>     
        </keep-alive> 
        </div>
    </div>


 
    
    <script src="/js/spa/app.js"></script>
</body>
</html>