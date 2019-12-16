<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class OrderController extends Controller
{
    const TABLE_NAME = 'order';

    public function doAddOrder(Request $req)
    {
        // validation

        $data = [];
        $data['user_id'] = Session::get('user_id');
        $data['name'] = $req->full_name;
        $data['address'] = $req->address;
        $data['phone'] = $req->phone;
        $data['email'] = $req->email;
        $data['created_at'] = time();
        $orderId = DB::table(self::TABLE_NAME)
            ->insertGetId($data);

        $url = $req->url;
        $arrayProductId = explode('-', $url);

        $arrProductId = [];
        $arrQty = [];
        foreach ($arrayProductId as $key => $item) {
            if ($key % 2 == 0) {
                array_push($arrProductId, $item);
            } else {
                array_push($arrQty, $item);
            }
        }

        $this->addCartProductToOrder($arrProductId, $arrQty, $orderId);
        $this->updateQtyInWareHouse($arrProductId, $arrQty);

        return Redirect::to('/cart');
    }

    public function addCartProductToOrder($arrProductId, $arrQty, $orderId)
    {

        $arrProductId = array_filter($arrProductId);
        $arrQty = array_filter($arrQty);

        $data = [];
        $data['order_id'] = $orderId;

        foreach ($arrProductId as $key => $productId) {
            $data['product_id'] = $productId;
            $data['product_qty'] = $arrQty[$key];
            $data['created_at'] = time();
            DB::table('order_product')
                ->insert($data);
        }

        Cart::destroy();

        Session::put('msg_check_out_success', 'Your order was checked out successfully! Thanks for shopping.');
    }

    public function updateQtyInWareHouse($arrProductId, $arrQty)
    {
        $data = [];
        $arrProductId = array_filter($arrProductId);
        foreach ($arrProductId as $key => $productId) {

            $product = DB::table('product')
                ->where('id', '=', $productId)
                ->first();
            $qtyInWareHouse = $product->qty;

            $data['qty'] = $qtyInWareHouse - $arrQty[$key];
            DB::table('product')
                ->where('id', '=', $productId)
                ->update($data);
        }
    }

    public function showAllOrderPage()
    {
        $listOrder = $this->getAllOrder();

        return view('pages.admin.order.All')
            ->with('listOrder', $listOrder);
    }

    public function getAllOrder()
    {
        return DB::table(self::TABLE_NAME)
            ->select(
                [
                    'user.name as user_name',
                    'product.name as product_name',
                    'order_product.product_qty as order_product_qty',
                    'product.id as product_id',
                    'order.id as order_id',
                    'user.email as user_email',
                    'order.created_at',
                    'order.updated_at',
                ]
            )
            ->join('user', self::TABLE_NAME . '.user_id', '=', 'user.id')
            ->join('order_product', self::TABLE_NAME . '.id', '=', 'order_product.order_id')
            ->join('product', 'order_product.product_id', '=', 'product.id')
            ->paginate(10);
    }
}
