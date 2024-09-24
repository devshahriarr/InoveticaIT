<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.body.storeManagement.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function allProducts()
    {
        //
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request);
        $products = new Product;
        $products->product_name = $request->name;
        $products->product_slug = Str::slug($request->name);
        $products->secure_token = '';
        $products->product_desc = $request->quillEditor;
        $products->product_img = $request->img;
        $products->product_tags = $request->pr_tags;
        $products->product_price = $request->price;
        $products->product_link = $request->pr_link;
        $products->status = 1;
        $products->product_cat_id = $request->Product_cat;

        if ($request->hasFile('image')) {
            $products->product_img = $this->handleImageUpload($request);
        }

        $products->save();

        return response()->json([
            'status' => 200,
            'message' => 'New Product added successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
