<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

session_start();

class CategoryController extends Controller
{
    const PATH_TO_CATEGORY = 'pages.admin.category.';
    const URL_TO_CATEGORY = '/admin/category';

    public function doShowAddCategoryPage()
    {
        return view(self::PATH_TO_CATEGORY . 'AddCategory');
    }

    public function doShowAllCategoryPage()
    {
        $listCategory = DB::table('category')
            ->where('is_deleted', '=', 0)
            ->get();
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
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
        } else {

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

            }
        } else {

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
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
        } else {

        }
    }

    public function deleteCategory($id)
    {
        if ($id) {
            $result = DB::table('category')
                ->where('id', '=', $id)
                ->update(['is_deleted' => 1, 'updated_at' => time()]);
            if ($result) {
                Session::put('msg_delete_success', 'Delete success');
            }
            return Redirect::to(self::URL_TO_CATEGORY . '/all');
        } else {

        }
    }
}
