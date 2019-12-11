@extends('layouts.AdminLayout')
@section('admin_content')
    <?php
    if (Session::get('msg_add_success') != null) {
        echo
            '<div class="alert alert-success">
                <strong>Success!</strong>' . Session::get('msg_add_success') .
            '</div>';
        Session::put('msg_add_success', null);
    }
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                CATEGORY
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th nowrap="true">Created At</th>
                        <th nowrap="true">Updated At</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCategory as $key => $category)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                        name="post[]"><i></i></label></td>
                            <td><span class="text-ellipsis">{{$category->name}}</span></td>
                            <td><span class="text-ellipsis">{{$category->code}}</span></td>
                            <td>
                                <span class="text-ellipsis">
                                    @if($category->status == 1)
                                        <a href="{{URL::to('/admin/category/changeStatus?id=')}}{{$category->id}}{{'&status=0'}}">
                                            <span class="label label-success">Active</span>
                                        </a>
                                    @else
                                        <a href="{{URL::to('/admin/category/changeStatus?id=')}}{{$category->id}}{{'&status=1'}}">
                                            <span class="label label-danger">Inactive</span>
                                        </a>
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="text-ellipsis">
                                    {{$category->created_at}}
                                </span>
                            </td>
                            <td>
                                <span class="text-ellipsis">
                                    {{$category->updated_at}}
                                </span>
                            </td>
                            <td>
                                <a href="" class="active" ui-toggle-class="">
                                    <i class="fa fa-pencil text-success text-active"></i>
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
