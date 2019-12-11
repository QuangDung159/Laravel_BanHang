@extends('layouts.AdminLayout')
@section('admin_content')
    <section class="panel">
        <header class="panel-heading">
            EDIT CATEGORY
        </header>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/admin/category/doEditCategory/' . $category->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Category name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name"
                               value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <label for="code">Category code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter category code"
                               value="{{$category->code}}">
                    </div>
                    <div class="form-group ">
                        <label for="description">Category description</label>
                        <textarea class="form-control" id="description" name="description"
                                  placeholder="Enter category description" style="resize: none;" rows="5">
                            {{$category->description}}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
    </section>
@endsection
