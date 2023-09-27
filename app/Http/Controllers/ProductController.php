<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal: 0,2',
            'description' => 'nullable'
        ]);

        $newProduct = product::create($data);
        return redirect(route('product.index'));
    }

    public function edit(product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal: 0,2',
            'description' => 'nullable'
        ]);

        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Product update successfully');
    }

    public function destroy(product $product){
        $product->delete();
        return redirect(route('product.index'))->with('success', 'Product deteted successfully');
    }
}
