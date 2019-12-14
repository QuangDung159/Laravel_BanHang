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
                                <a href="{{URL::to('/product')}}/{{$item->id}}"><img width="150"
                                                                                     src="{{asset('/upload/product')}}/{{$item->options->image}}"
                                                                                     alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{URL::to('/product')}}/{{$item->id}}">{{$item->name}}</a></h4>
                                <p>Web ID: {{$item->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>${{$item->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{URL::to('/doUpdateQtyInCart')}}/{{$item->rowId}}" method="post">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-check"></i>
                                        </button>
                                        <input class="cart_quantity_input" type="text" name="qty"
                                               value="{{$item->qty}}"
                                               autocomplete="off" size="2">
                                    </form>
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
                <div style="text-align: center">
                    @if (count($cart) == 0)
                        <h2><a href="{{URL::to('/home')}}">Let's shopping!</a></h2>
                    @endif
                </div>
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
                                <li>Total <span>${{$total}}</span></li>
                            </ul>
                        </div>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
