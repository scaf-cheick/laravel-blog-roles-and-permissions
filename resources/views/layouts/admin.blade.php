<!DOCTYPE html>
<html lang="en">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>@section('title') {{config('app.name')}} @show</title>

        <meta property="og:title" content="@section('title') {{config('app.name')}} @show" />
        <meta name="description" content="@section('description') {{config('app.name')}} @show">
        <meta property="og:url" content="@section('url') @show" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="@section('image'){{asset('uploads/logo.png')}}@show"/>
        <meta property="og:copyright" content=" {{config('app.name')}} " />
        <meta property="og:developer_lead" content="SOURGOU Franck" />
        <meta name="author" content="Sourgou Franck - f.sourgou@fasonumerique.com">
        <meta property="og:site_name" content="" />
        <link href="{{asset('materialize/css/animate.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{asset('materialize/css/aos.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{asset('materialize/css/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{asset('materialize/css/style-admin.css')}}" type="text/css" rel="stylesheet"/>
        <link href="{{asset('materialize/iconfont/material-icons.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="shortcut icon" href="{{asset('images/logo.png')}}">

        
    </head>

    <body class="fontfamily">

        @include('layouts.partials._nav-admin')

        
        <div class="main">
          
            @yield('content')
                   
        </div>

      
        @include('layouts.partials._footer-admin')



        <script src="{{asset('materialize/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('materialize/js/aos.min.js')}}"></script>
        <script src="{{asset('materialize/js/materialize.min.js')}}"></script>
        <script src="{{asset('materialize/js/scrypt.js')}}"></script>
        

        @stack('js')
        @stack('notification')

    </body>
</html>