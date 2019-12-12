@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            EDIT PRODUCT
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/product/doEdit/' . $product->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name"
                               value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                        <label for="code">Product code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter product code"
                               value="{{$product->code}}">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
    </section>
@endsection
