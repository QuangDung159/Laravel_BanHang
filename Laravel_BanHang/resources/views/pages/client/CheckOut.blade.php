@extends('layouts.Layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="review-payment">
                <h2>Review & Payment</h2>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $key => $product)
                        <tr>
                            <td class="cart_product">
                                <a href="{{URL::to('/product')}}/{{$product->id}}"><img width="150"
                                                                                        src="{{asset('/upload/product')}}/{{$product->options->image}}"
                                                                                        alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{URL::to('/product')}}/{{$product->id}}">{{$product->name}}</a></h4>
                                <p>Web ID: {{$product->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>${{$product->price}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{$product->qty}}</p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{$product->price * $product->qty}}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>${{$total}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class="form-one">
                                <form action="{{URL::to('/doAddOrder?url=')}}{{$url}}" method="post">
                                    {{csrf_field()}}
                                    <input type="text" name="full_name" placeholder="Full Name">
                                    <input type="text" name="email" placeholder="Email">
                                    <input type="text" name="address" placeholder="Address">
                                    <input type="text" name="phone" placeholder="Phone">
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message" placeholder="Notes about your order, Special Notes for Delivery"
                                      rows="16"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
