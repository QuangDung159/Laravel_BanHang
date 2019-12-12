@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            ADD NEW PRODUCT
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/product/doAdd')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="brand_id">Brand name</label>
                        <select class="form-control input-sm m-bot15" id="brand_id" name="brand_id">
                            @foreach($listBrand as $key => $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category name</label>
                        <select class="form-control input-sm m-bot15" id="category_id" name="category_id">
                            @foreach($listCategory as $key => $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                        <label for="code">Product code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter product code">
                    </div>
                    <div class="form-group ">
                        <label for="description">Product description</label>
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Enter category description" style="resize: none;" rows="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="content">Product content</label>
                        <textarea class="form-control" id="content" name="content"
                                  placeholder="Enter category content" style="resize: none;" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Product price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter product price">
                    </div>
                    <div class="form-group">
                        <label for="image">Product image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="status">Product status</label>
                        <select class="form-control input-sm m-bot15" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
    </section>
@endsection
