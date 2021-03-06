@extends('layouts.Layout')
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{asset('/upload/product')}}/{{$product->image}}" alt=""/>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active" style="text-align: center">
                            <a href=""><img src="{{asset('/client/images/similar1.jpg')}}" alt=""></a>
                        </div>
                        <div class="item" style="text-align: center">
                            <img
                                src="{{asset('/client/images/similar2.jpg')}}"
                                alt="">
                        </div>
                        <div class="item" style="text-align: center">
                            <a href=""><img src="{{asset('/client/images/similar3.jpg')}}" alt=""></a>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt=""/>
                    <h2>{{$product->name}}</h2>
                    <p>Web ID: {{$product->code}}</p>
                    @if ($product->qty > 0)
                        <p>Status: Available</p>
                    @else
                        <p>Status: Out of stock</p>
                    @endif
                    <img src="{{asset('client/images/rating.png')}}" alt=""/>
                    <form action="{{URL::to('/doAddToCart')}}" method="post">
                        {{csrf_field()}}
                        <span>
                            <span>US ${{$product->price}}</span>
                            <label>Quantity:</label>
                            <input type="text" value="1" name="qty"/>
                            <input type="hidden" value="{{$product->id}}" name="product_id"/>
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
                        </span>
                    </form>
                    <p><b>Brand:</b> {{$product->brand_name}}</p>
                    <p><b>Category:</b> {{$product->category_name}}</p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt=""/></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews ({{$numberOfComment}})</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <div class="col-sm-11">
                        @if ($product->content != '')
                            <p>{!!$product->content!!}</p>
                        @else
                            <p>The content is being updated.</p>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        @foreach($listComment as $key => $comment)
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>{{$comment->name}}</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>{{date('H:i:s', $comment->created_at)}}</a>
                                </li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>{{date('Y/m/d', $comment->created_at)}}
                                    </a></li>
                            </ul>
                            <p>{{$comment->content}}</p>
                            <hr/>
                        @endforeach

                        <p><b>Write Your Review</b></p>
                        @if (Session::get('user_id') != '')
                            <form action="{{URL::to('/submitComment')}}" method="post">
                                {{csrf_field()}}
                                <textarea name="cmt_content"></textarea>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-default pull-right">
                                    Submit
                                </button>
                            </form>
                        @else
                            <div class="panel panel-danger">
                                <div class="panel-body">You must login to leave a comment. <a
                                        href="{{URL::to('/login')}}">Login now.</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($listProductRecommend as $key1 => $tripleProduct)
                        @if ($key1 == 0)
                            <div class="item active">
                                @foreach($tripleProduct as $key => $product)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('/upload/product')}}/{{$product->image}}" alt=""/>
                                                    <h2>{{$product->price}}</h2>
                                                    <p>{{$product->name}}</p>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="item">
                                @foreach($tripleProduct as $key => $product)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('/upload/product')}}/{{$product->image}}" alt=""/>
                                                    <h2>{{$product->price}}</h2>
                                                    <p>{{$product->name}}</p>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->
    </div>
@endsection
