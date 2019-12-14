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
