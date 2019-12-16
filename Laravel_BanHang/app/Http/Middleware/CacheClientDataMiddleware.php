<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CacheClientDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        self::cacheListCategory();
        self::cacheListBrand();
        return $next($request);
    }

    public function cacheListCategory()
    {
        $listCategory = Redis::get('list_category');
        if (!$listCategory) {
            $listCategory = DB::table('category')
                ->select(
                    [
                        'category.id',
                        'category.name',
                    ]
                )
                ->where('is_deleted', '=', 0)
                ->where('status', '=', 1)
                ->get();

            Redis::set('list_category', json_encode($listCategory));
        }
    }

    public function cacheListBrand()
    {
        $listBrand = Redis::get('list_brand');
        if (!$listBrand) {
            $listBrand = DB::table('brand')
                ->select(
                    [
                        'brand.id',
                        'brand.name',
                        DB::raw('COUNT(product.id) as number_product'),
                    ]
                )
                ->where('brand.is_deleted', '=', 0)
                ->where('brand.status', '=', 1)
                ->leftJoin('product', 'brand.id', '=', 'product.brand_id')
                ->groupBy('brand.id', 'brand.name')
                ->get();

            Redis::set('list_brand', json_encode($listBrand));
        }
    }
}
