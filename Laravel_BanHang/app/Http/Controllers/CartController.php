<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    const PATH_CLIENT = 'pages.client.';
    const URL_CART = '/cart';

    public function doAddToCart(Request $req)
    {
        $productId = $req->product_id;
        $qty = $req->qty;
        if (!$productId) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        if ($qty == 0) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        $product = DB::table('product')
            ->where('product.id', '=', $productId)
            ->where('product.is_deleted', '=', 0)
            ->where('product.status', '=', 1)
            ->where('product.qty', '>=', $qty)
            ->first();

        if (!$product) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        $data = [];
        $data['id'] = $productId;
        $data['qty'] = $qty;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['weight'] = 0;
        $data['options']['image'] = $product->image;
        Cart::add($data);
        return redirect(self::URL_CART);
    }

    public function showCartPage()
    {
        $listCategory = json_decode(Redis::get('list_category'));
        $listBrand = json_decode(Redis::get('list_brand'));

        $cart = Cart::content();

        return view(self::PATH_CLIENT . 'Cart')
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory)
            ->with('isShowSlider', false)
            ->with('isShowSideBar', false)
            ->with('cart', $cart);
    }

    public function doRemoveItemInCart($rowId)
    {
        if (!$rowId) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        Cart::remove($rowId);

        return redirect(self::URL_CART);
    }
}
