<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/responsive.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="{{asset('client/js/html5shiv.js')}}"></script>
    <script src="{{asset('client/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('client/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('client/images/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('client/images/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('client/images/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('client/images/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<div class="container text-center">
    <div class="logo-404">
        <a href="{{URL::to('/home')}}"><img src="{{asset('/client/images/logo.png')}}" alt=""/></a>
    </div>
    <div class="content-404">
        <img width="500" src="{{asset('/client/images/404.png')}}" class="img-responsive" alt=""/>
        <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
        <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
        <h2><a href="{{URL::to('/home')}}">Bring me back Home</a></h2>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>
