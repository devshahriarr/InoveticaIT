<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class productCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('backend.body.storeManagement.productCategory.category');
        $product_categories = ProductCategory::all();
        return view('backend.body.storeManagement.productCategory.category', compact('product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|max:100',
            'categoryImage' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        if ($validator->passes()) {
            // dd($request->all());
            $category = new ProductCategory;

            if ($request->categoryImage) {
                // dd( $request->categoryImage);
                $imageName = rand() . '.' . $request->categoryImage->extension();
                $request->categoryImage->move(public_path('uploads/store/product/categoryImage/'), $imageName);
                // dd( $imageName);
                $category->image = $imageName;
                // dd( $category->image);
            }
            $category->categoryName =  $request->categoryName;
            $category->slug = Str::slug($request->categoryName);
            $category->status = 0;
            $category->save();
            // dd( $category);
            return response()->json([
                'status' => 200,
                'message' => 'Category Save Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
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
