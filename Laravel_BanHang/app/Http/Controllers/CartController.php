<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
