<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

session_start();

class BrandController extends Controller
{
    const PATH = 'pages.admin.brand.';
    const URL = '/admin/brand';
    const TABLE_NAME = 'brand';
    const PATH_TO_CLIENT = 'pages.client.';

    // admin
    public function doShowAddPage()
    {
        return view(self::PATH . 'Add');
    }

    public function doShowAllPage()
    {
        $listBrand = DB::table(self::TABLE_NAME)
            ->where('is_deleted', '=', 0)
            ->get();
        return view(self::PATH . 'All')->with('listBrand', $listBrand);
    }

    public function doAdd(Request $req)
    {
        Session::put('mgs_add_success', null);
        $data = array();
        $data['name'] = $req->name;
        $data['code'] = $req->code;
        $data['status'] = $req->status;
        $data['created_at'] = time();
        $data['updated_at'] = time();

        if (count($data) != 0) {
            DB::table(self::TABLE_NAME)->insert($data);
            Session::put('msg_add_success', 'Add success');
            return Redirect::to(self::URL . '/all');
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function changeStatus(Request $req)
    {
        $id = $req->id;
        $status = $req->status;
        $data = ['status' => $status, 'updated_at' => time()];
        if ($id != null || $status != null) {
            DB::table(self::TABLE_NAME)->where('id', '=', $id)
                ->update($data);

            $listProductByBrand = DB::table('product')
                ->where(self::TABLE_NAME . '_id', '=', $id)
                ->get();

            foreach ($listProductByBrand as $product) {
                DB::table('product')
                    ->where('product.id', '=', $product->id)
                    ->update(['product.status' => $status]);
            }

            Session::put('msg_update_success', 'Update success');
        }
        return Redirect::to(self::URL . '/all');
    }

    public function showEditPage($id)
    {
        if ($id) {
            $data = DB::table(self::TABLE_NAME)
                ->where('id', '=', $id)
                ->first();
            if ($data) {
                return view(self::PATH . 'Edit')
                    ->with('brand', $data);
            } else {
                return view('pages.admin.NotFound');
            }
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function doEdit($id, Request $req)
    {
        if ($id) {
            $data = [
                'name' => $req->name,
                'code' => $req->code,
                'updated_at' => time()
            ];
            $result = DB::table(self::TABLE_NAME)
                ->where('id', '=', $id)
                ->update($data);
            if ($result) {
                Session::put('msg_update_success', 'Update success');
            }
            return Redirect::to(self::URL . '/all');
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function doDelete($id)
    {
        if ($id) {
            $listProductByBrand = DB::table('product')
                ->where(self::TABLE_NAME . '_id', '=', $id)
                ->get();

            if (count($listProductByBrand) != 0) {
                Session::put('msg_delete_fail', 'Delete fail! There are a number of products in this brand');
                return Redirect::to(self::URL . '/all');
            }

            $result = DB::table(self::TABLE_NAME)
                ->where('id', '=', $id)
                ->update(['is_deleted' => 1, 'updated_at' => time()]);
            if ($result) {
                Session::put('msg_delete_success', 'Delete success');
            }
            return Redirect::to(self::URL . '/all');
        } else {
            return view('pages.admin.NotFound');
        }
    }

    // client
    public function showProductByBrand($id)
    {
        if ($id) {
            $listProduct = DB::table('product')
                ->where('product.is_deleted', '=', 0)
                ->where('product.status', '=', 1)
                ->where('product.brand_id', '=', $id)
                ->get();

            $brand = DB::table(self::TABLE_NAME)
                ->where(self::TABLE_NAME . '.id', '=', $id)
                ->get(
                    [
                        self::TABLE_NAME . '.id',
                        self::TABLE_NAME . '.name'
                    ]
                )->first();

            if (!$brand) {
                return view('pages.client.NotFound');
            }

            $listCategory = json_decode(Redis::get('list_category'));

            $listBrand = json_decode(Redis::get('list_brand'));

            return view(self::PATH_TO_CLIENT . 'ProductByBrand')
                ->with('listProduct', $listProduct)
                ->with('brand', $brand)
                ->with('listCategory', $listCategory)
                ->with('listBrand', $listBrand)
                ->with('isShowSlider', false)
                ->with('isShowSideBar', true);
        } else {
            return view('pages.client.NotFound');
        }
    }
}
