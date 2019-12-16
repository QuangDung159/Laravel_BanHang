@extends('layouts.AdminLayout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                ORDER
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
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th nowrap="true">Created At</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrder as $key => $order)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                        name="post[]"><i></i></label></td>
                            <td><span class="text-ellipsis">{{$order->order_id}}</span></td>
                            <td><span class="text-ellipsis">{{$order->user_name}}</span></td>
                            <td><span class="text-ellipsis">{{$order->user_email}}</span></td>
                            <td><span class="text-ellipsis">{{$order->product_name}}</span></td>
                            <td><span class="text-ellipsis">{{$order->order_product_qty}}</span></td>
                            <td>
                                <span class="text-ellipsis">
                                    {{date('Y/m/d H:i:s', $order->created_at)}}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <small
                            class="text-muted inline m-t-sm m-b-sm">
                            Showing {{$listOrder->firstItem()}}
                            - {{$listOrder->lastItem()}}
                            of {{$listOrder->total()}} items
                        </small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        @foreach ($listOrder as $key => $order)
                        @endforeach
                        {!! $listOrder->links() !!}
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
