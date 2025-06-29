<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () 
    {
        dd('test');
    }

    public function getProduct ()
    {
        $products = [
            'id' => 1,
            'name' => 'Obat Batuk',
            'image' => 1,
            'category_id' => 1,
            'created_at' => '1970-01-01 00:00:01',
            'deleted_at' => '1970-01-01 00:00:01',
        ];

        return view ('products.index', compact('products'));
    }
}
