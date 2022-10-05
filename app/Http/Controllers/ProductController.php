<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('products', [
            'products' => Product::all()
        ]);
    }

    public function addItem(Request $request)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->id
        ]);
        session()->flash('success', 'Prece pievienota grozam!');
        return back();
    }
}
