<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

session_start();

class CategoryController extends Controller
{
    const PATH_TO_CATEGORY = 'pages.admin.category.';
    const URL_TO_CATEGORY = '/admin/category';
    const TABLE_NAME = 'category';
    const PATH_TO_CLIENT = 'pages.client.';
    const URL_TO_CLIENT_CATEGORY = '/category';

    // admin
    public function doShowAddCategoryPage()
    {
        return view(self::PATH_TO_CATEGORY . 'AddCategory');
    }

    public function doShowAllCategoryPage()
    {
        $listCategory = DB::table('category')
            ->where('is_deleted', '=', 0)
            ->paginate(10);
        return view(self::PATH_TO_CATEGORY . 'AllCategory')->with('listCategory', $listCategory);
    }

    public function doAddCategory(Request $req)
    {
        Session::put('mgs_add_success', null);
        $data = array();
        $data['name'] = $req->name;
        $data['code'] = $req->code;
        $data['description'] = $req->description;
        $data['status'] = $req->status;
        $data['created_at'] = time();
        $data['updated_at'] = time();

        if (count($data) != 0) {
            DB::table('category')->insert($data);
            Session::put('msg_add_success', 'Add success');
            Redis::del('list_category');
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
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
            DB::table('category')->where('id', '=', $id)
                ->update($data);

            $listProductByCategory = DB::table('product')
                ->where(self::TABLE_NAME . '_id', '=', $id)
                ->get();

            foreach ($listProductByCategory as $product) {
                DB::table('product')
                    ->where('product.id', '=', $product->id)
                    ->update(['product.status' => $status]);
            }

            Session::put('msg_update_success', 'Update success');
        }
        return Redirect::to(self::URL_TO_CATEGORY . '/all');
    }

    public function showEditCategoryPage($id)
    {
        if ($id) {
            $data = DB::table('category')
                ->where('id', '=', $id)
                ->first();
            if ($data) {
                return view(self::PATH_TO_CATEGORY . 'EditCategory')
                    ->with('category', $data);
            } else {
                return view('pages.admin.NotFound');
            }
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function doEditCategory($id, Request $req)
    {
        if ($id) {
            $data = [
                'name' => $req->name,
                'code' => $req->code,
                'description' => $req->description,
                'updated_at' => time()
            ];
            $result = DB::table('category')
                ->where('id', '=', $id)
                ->update($data);
            if ($result) {
                Session::put('msg_update_success', 'Update success');
            }
            Redis::del('list_category');
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function deleteCategory($id)
    {
        if ($id) {
            $listProductByCategory = DB::table('product')
                ->where(self::TABLE_NAME . '_id', '=', $id)
                ->get();

            if (count($listProductByCategory) != 0) {
                Session::put('msg_delete_fail', 'Delete fail! There are a number of products in this category');
                return Redirect::to(self::URL_TO_CATEGORY . '/all');
            }

            $result = DB::table('category')
                ->where('id', '=', $id)
                ->update(['is_deleted' => 1, 'updated_at' => time()]);
            if ($result) {
                Session::put('msg_delete_success', 'Delete success');
            }
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
        } else {
            return view('pages.admin.NotFound');
        }
    }

    // client
    public function showProductByCategory($id)
    {
        if ($id) {
            $listProduct = DB::table('product')
                ->where('product.is_deleted', '=', 0)
                ->where('product.status', '=', 1)
                ->where('product.category_id', '=', $id)
                ->get();

            $category = DB::table(self::TABLE_NAME)
                ->where(self::TABLE_NAME . '.id', '=', $id)
                ->get(
                    [
                        self::TABLE_NAME . '.id',
                        self::TABLE_NAME . '.name'
                    ]
                )->first();

            if (!$category) {
                return view('pages.client.NotFound');
            }

            $listCategory = json_decode(Redis::get('list_category'));
            $listBrand = json_decode(Redis::get('list_brand'));

            return view(self::PATH_TO_CLIENT . 'ProductByCategory')
                ->with('listProduct', $listProduct)
                ->with('category', $category)
                ->with('listCategory', $listCategory)
                ->with('listBrand', $listBrand)
                ->with('isShowSlider', false)
                ->with('isShowSideBar', true);
        } else {
            return view('pages.client.NotFound');
        }
    }
}
