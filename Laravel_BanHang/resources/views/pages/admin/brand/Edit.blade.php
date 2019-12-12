@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            EDIT BRAND
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/brand/doEdit/' . $brand->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Brand name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter brand name"
                               value="{{$brand->name}}">
                    </div>
                    <div class="form-group">
                        <label for="code">Brand code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter brand code"
                               value="{{$brand->code}}">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
    </section>
@endsection
