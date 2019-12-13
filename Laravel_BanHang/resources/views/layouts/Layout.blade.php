<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>

    <!-- asset stand for /public/ -->
    <link href="{{asset('/client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('/client/css/responsive.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
@include('layouts.Header')
<!--/header-->

@include('layouts.Slider')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach($listCategory as $key => $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="{{URL::to('/category')}}/{{$category->id}}">
                                            {{$category->name}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($listBrand as $key => $brand)
                                    <li>
                                        <a href="{{URL::to('/brand')}}/{{$brand->id}}">
                                            <span class="pull-right">
                                                ({{$brand->number_product}})
                                            </span>{{$brand->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="{{asset('client/images/shipping.jpg')}}" alt=""/>
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>

@include('layouts.Footer')
<!--/Footer-->


<script src="{{asset('client/js/jquery.js')}}"></script>
<script src="{{asset('client/js/bootstrap.min.js')}}"></script>
<script src="{{asset('client/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('client/js/price-range.js')}}"></script>
<script src="{{asset('client/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('client/js/main.js')}}"></script>
</body>

</html>
