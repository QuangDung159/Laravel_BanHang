<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        DB::table(self::TABLE_NAME)
            ->insert($data);

        return Redirect::to('/cart');
    }
}
