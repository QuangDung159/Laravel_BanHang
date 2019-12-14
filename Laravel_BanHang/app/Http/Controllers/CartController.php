<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    const PATH_CLIENT = 'pages.client.';

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

        $data = DB::table('product')
            ->where('product.id', '=', $productId)
            ->where('product.is_deleted', '=', 0)
            ->where('product.status', '=', 1)
            ->where('product.qty', '>=', $qty)
            ->first();


        if (!$data) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

    }

    public function showCartPage()
    {
        $listCategory = json_decode(Redis::get('list_category'));
        $listBrand = json_decode(Redis::get('list_brand'));

        return view(self::PATH_CLIENT . 'Cart')
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory)
            ->with('isShowSlider', false)
            ->with('isShowSideBar', false);
    }
}
