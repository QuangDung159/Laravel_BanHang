<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    const PATH_TO_CLIENT_PAGES_DIRECTORY = "pages.client.";

    public function index()
    {
        return view(self::PATH_TO_CLIENT_PAGES_DIRECTORY . 'Home');
    }
}
