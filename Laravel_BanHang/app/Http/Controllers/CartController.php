<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    const PATH_CLIENT = 'pages.client.';

    public function doAddToCart($id)
    {
        if (!$id) {
            return view(self::PATH_CLIENT . 'NotFound');
        }


    }
}
