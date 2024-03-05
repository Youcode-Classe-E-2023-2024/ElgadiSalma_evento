<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function categoryView()
    {
        return view('Categories.category');
    }

}
