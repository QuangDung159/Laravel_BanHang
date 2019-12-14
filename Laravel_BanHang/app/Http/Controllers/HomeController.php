<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    const PATH_TO_CLIENT_PAGES_DIRECTORY = "pages.client.";

    public function index()
    {
        $listCategory = json_decode(Redis::get('list_category'));

        $listBrand = json_decode(Redis::get('list_brand'));

        $listProduct = DB::table('product')
            ->where('product.is_deleted', '=', 0)
            ->where('product.status', '=', 1)
            ->where('product.qty', '>', 0)
            ->orderBy('rate')
            ->limit(6)
            ->get();

        return view(self::PATH_TO_CLIENT_PAGES_DIRECTORY . 'Home')
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory)
            ->with('listProduct', $listProduct)
            ->with('isShowSlider', true)
            ->with('isShowSideBar', true);
    }
}
