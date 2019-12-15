<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

session_start();

class ProductController extends Controller
{
    const PATH = 'pages.admin.product.';
    const URL = '/admin/product';
    const PATH_CLIENT = 'pages.client.';
    const URL_CLIENT = '/product';
    const TABLE_NAME = 'product';
    const PATH_TO_UPLOAD_PRODUCT = '/upload/product';

    // admin
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
            ->join('category', self::TABLE_NAME . '.category_id', '=', 'category.id')
            ->join('brand', self::TABLE_NAME . '.brand_id', '=', 'brand.id')
            ->where(self::TABLE_NAME . '.is_deleted', '=', 0)
            ->where('category.is_deleted', '=', 0)
            ->where('brand.is_deleted', '=', 0)
            ->get(
                [
                    self::TABLE_NAME . '.name',
                    self::TABLE_NAME . '.id',
                    self::TABLE_NAME . '.code',
                    self::TABLE_NAME . '.status',
                    self::TABLE_NAME . '.price',
                    self::TABLE_NAME . '.rate',
                    self::TABLE_NAME . '.image',
                    self::TABLE_NAME . '.created_at',
                    self::TABLE_NAME . '.updated_at',
                    'category.name as category_name',
                    'brand.name as brand_name'
                ]
            );
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
        $data['content'] = $req->content1;
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

            $listBrand = DB::table('brand')
                ->where('is_deleted', '=', 0)
                ->where('status', '=', 1)->get();

            $listCategory = DB::table('category')
                ->where('is_deleted', '=', 0)
                ->where('status', '=', 1)->get();

            if ($data) {
                return view(self::PATH . 'Edit')
                    ->with('product', $data)
                    ->with('listBrand', $listBrand)
                    ->with('listCategory', $listCategory);
            } else {
                return view('pages.admin.NotFound');
            }
        } else {
            return view('pages.admin.NotFound');
        }
    }

    public function doEdit($id, Request $req)
    {
        Session::put('mgs_add_success', null);
        if ($id) {
            $data = array();
            $data['name'] = $req->name;
            $data['code'] = $req->code;
            $data['category_id'] = $req->category_id;
            $data['brand_id'] = $req->brand_id;
            $data['content'] = $req->product_content;
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
                DB::table(self::TABLE_NAME)
                    ->where(self::TABLE_NAME . '.id', '=', $id)
                    ->update($data);
                Session::put('msg_update_success', 'Update success');
                return Redirect::to(self::URL . '/all');
            } else {
                return view('pages.admin.NotFound');
            }
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

    // client
    public function showProductDetailPage($id)
    {
        $listCategory = json_decode(Redis::get('list_category'));
        $listBrand = json_decode(Redis::get('list_brand'));

        if (!$id) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        $product = DB::table(self::TABLE_NAME)
            ->select(['product.*', 'category.name as category_name', 'brand.name as brand_name'])
            ->join('brand', self::TABLE_NAME . '.brand_id', '=', 'brand.id')
            ->join('category', self::TABLE_NAME . '.category_id', '=', 'category.id')
            ->where(self::TABLE_NAME . '.id', '=', $id)
            ->where(self::TABLE_NAME . '.is_deleted', '=', 0)
            ->where(self::TABLE_NAME . '.status', '=', 1)
            ->first();

        if (!$product) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        $listProductRecommend = $this->getListRecommendProductByCategoryId($product->category_id, $id);

        $arrProduct = [];

        foreach ($listProductRecommend as $item) {
            array_push($arrProduct, $item);
        }

        $arrProductRecommend = array_chunk($arrProduct, 3);
        $listComment = $this->getCommentByProductId($product->id);

        return view(self::PATH_CLIENT . 'ProductDetail')
            ->with('listCategory', $listCategory)
            ->with('listBrand', $listBrand)
            ->with('product', $product)
            ->with('listProductRecommend', $arrProductRecommend)
            ->with('isShowSlider', false)
            ->with('isShowSideBar', true)
            ->with('listComment', $listComment)
            ->with('numberOfComment', count($listComment));
    }

    public function getListRecommendProductByCategoryId($categoryId, $productId)
    {
        return DB::table(self::TABLE_NAME)
            ->select([self::TABLE_NAME . '.*', 'category.name as category_name'])
            ->join('category', self::TABLE_NAME . '.category_id', '=', 'category.id')
            ->where(self::TABLE_NAME . '.category_id', '=', $categoryId)
            ->where(self::TABLE_NAME . '.is_deleted', '=', 0)
            ->where(self::TABLE_NAME . '.status', '=', 1)
            ->where(self::TABLE_NAME . '.id', '!=', $productId)
            ->limit(9)
            ->orderByDesc(self::TABLE_NAME . '.rate')
            ->get();
    }

    public function submitComment(Request $req)
    {
        // validation

        $productId = $req->product_id;
        $content = $req->cmt_content;
        $userId = Session::get('user_id');

        $data = [];
        $data['product_id'] = $productId;
        $data['content'] = $content;
        $data['user_id'] = $userId;
        $data['created_at'] = time();

        DB::table('comment')
            ->insert($data);

        return Redirect::to('/product/' . $productId);
    }

    public function getCommentByProductId($productId)
    {
        if (!$productId) {
            return view(self::PATH_CLIENT . 'NotFound');
        }

        return DB::table(self::TABLE_NAME)
            ->select(['comment.content', 'user.name', 'comment.created_at'])
            ->join('comment', self::TABLE_NAME . '.id', '=', 'comment.product_id')
            ->join('user', 'comment.user_id', '=', 'user.id')
            ->where(self::TABLE_NAME . '.id', '=', $productId)
            ->get();
    }
}
