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
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                        <label for="code">Product code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter product code">
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
