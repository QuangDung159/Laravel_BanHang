@extends('layouts.Layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $key => $item)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img width="150" src="{{asset('/upload/product')}}/{{$item->options->image}}"
                                                alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item->name}}</a></h4>
                                <p>Web ID: {{$item->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>${{$item->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <input class="cart_quantity_input" type="text" name="qty"
                                           value="{{$item->qty}}"
                                           autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{$item->price * $item->qty}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"
                                   href="{{URL::to('/doRemoveItemInCart')}}/{{$item->rowId}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="total_area">
                        <div class="col-sm-6">
                            <ul>
                                <li>Cart Sub Total <span>$59</span></li>
                                <li>Eco Tax <span>$2</span></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span>$61</span></li>
                            </ul>
                        </div>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
