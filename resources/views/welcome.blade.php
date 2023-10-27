<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
      
        <link href="css/main.css" rel="stylesheet">
        <link href="css/grid.min.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">

        <!-- Styles -->
        <style>   </style>
        <script>
            (function(){
                window.Laravel = {
                    csrfToken: '{{ csrf_token()}}'
                };
            })();
        </script>



    </head>
    <body>
    <div id="app">
    <h1>This is welcome page</h1>
  
     <main-app></main-app>
    
    </div>
    </body>
    <script src="{{mix('/js/app.js')}}"></script>
</html>
