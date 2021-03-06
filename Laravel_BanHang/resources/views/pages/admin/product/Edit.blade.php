@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            EDIT PRODUCT
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/product/doEdit')}}/{{$product->id}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="brand_id">Brand name</label>
                        <select class="form-control input-sm m-bot15" id="brand_id" name="brand_id">
                            @foreach($listBrand as $key => $brand)
                                @if ($brand->id == $product->brand_id)
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category name</label>
                        <select class="form-control input-sm m-bot15" id="category_id" name="category_id">
                            @foreach($listCategory as $key => $category)
                                @if ($category->id == $product->category_id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}"
                               placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                        <label for="code">Product code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{$product->code}}"
                               placeholder="Enter product code">
                    </div>
                    <div class="form-group ">
                        <label for="description">Product description</label>
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Enter category description" style="resize: none;" rows="5">
                            {{$product->description}}
                        </textarea>
                    </div>
                    <div class="form-group ">
                        <label for="product_content">Product content</label>
                        <textarea class="form-control" id="product_content" name="product_content"
                                  placeholder="Enter category content" style="resize: none;" rows="10">
                            {{$product->content}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Product price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}"
                               placeholder="Enter product price">
                    </div>
                    <div class="form-group">
                        <label for="image">Product image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
