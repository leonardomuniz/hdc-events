<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $busca = request('search');

        return view('produtos.products', [
            'busca' => $busca,
        ]);
    }

    public function product($id = null) {
        return view('produtos.product', ['id' => $id]);
    }
}
