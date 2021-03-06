@extends('layouts.Layout')
@section('content')
    <div class="wrapper">
        <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">{{$category->name}}</h2>
            @foreach($listProduct as $key => $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('upload/product')}}/{{$product->image}}" alt=""/>
                                <h2>${{$product->price}}</h2>
                                <p>{{$product->name}}</p>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <form action="{{URL::to('/doAddToCart')}}" method="post">
                                        {{csrf_field()}}
                                        <h2><a href="{{URL::to('/product')}}/{{$product->id}}">${{$product->price}}</a>
                                        </h2>
                                        <p><a href="{{URL::to('/product')}}/{{$product->id}}">{{$product->name}}</a></p>
                                        <input type="hidden" value="1" name="qty">
                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                        @if($product->qty > 0)
                                            <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-fefault cart" disabled>
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!--features_items-->
    </div>
@endsection
