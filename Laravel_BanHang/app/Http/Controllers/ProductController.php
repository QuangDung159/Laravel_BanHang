<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class ProductController extends Controller
{
    const PATH = 'pages.admin.product.';
    const URL = '/admin/product';
    const TABLE_NAME = 'product';
    const PATH_TO_UPLOAD_PRODUCT = '/upload/product';

    public function doShowAddPage()
    {
        $listBrand = DB::table('brand')
            ->where('is_deleted', '=', 0)
            ->where('status', '=', 1)->get();

        $listCategory = DB::table('category')
            ->where('is_deleted', '=', 0)
            ->where('status', '=', 1)->get();

        return view(self::PATH . 'Add')
            ->with('listBrand', $listBrand)
            ->with('listCategory', $listCategory);
    }

    public function doShowAllPage()
    {
        $listProduct = DB::table(self::TABLE_NAME)
            ->where('is_deleted', '=', 0)
            ->get();
        return view(self::PATH . 'All')->with('listProduct', $listProduct);
    }

    public function doAdd(Request $req)
    {
        Session::put('mgs_add_success', null);
        $data = array();
        $data['name'] = $req->name;
        $data['code'] = $req->code;
        $data['status'] = $req->status;
        $data['category_id'] = $req->category_id;
        $data['brand_id'] = $req->brand_id;
        $data['content'] = $req->content;
        $data['description'] = $req->description;
        $data['price'] = $req->price;
        $data['created_at'] = time();
        $data['updated_at'] = time();

        $image = $req->file('image');
        if ($image) {
            $newName = time() . '_' . rand(0, 9) . '_' . $req->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . self::PATH_TO_UPLOAD_PRODUCT, $newName);
            $data['image'] = $newName;
        }

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
}
