@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            ADD NEW CATEGORY
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/category/doAddCategory')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Category name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="code">Category code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter category code">
                    </div>
                    <div class="form-group ">
                        <label for="description">Category description</label>
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Enter category description" style="resize: none;" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Category status</label>
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
