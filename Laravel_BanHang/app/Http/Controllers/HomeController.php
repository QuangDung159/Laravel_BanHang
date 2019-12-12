<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const PATH_TO_CLIENT_PAGES_DIRECTORY = "pages.client.";

    public function index()
    {
        $listBrand = DB::table('brand')
            ->select(
                [
                    'brand.id',
                    'brand.name',
                    DB::raw('COUNT(product.id) as number_product')
                ]
            )
            ->where('brand.is_deleted', '=', 0)
            ->where('brand.status', '=', 1)
            ->leftJoin('product', 'brand.id', '=', 'product.brand_id')
            ->groupBy('brand.id', 'brand.name')
            ->get();

        $listCategory = DB::table('category')
            ->where('is_deleted', '=', 0)
            ->where('status', '=', 1)->get();

        $listProduct = DB::table('product')
            ->where('product.is_deleted', '=', 0)
            ->where('product.status', '=', 1)
            ->orderBy('created_at')
            ->limit(6)
            ->get();

        return view(self::PATH_TO_CLIENT_PAGES_DIRECTORY . 'Home')
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory)
            ->with('listProduct', $listProduct);
    }
}
