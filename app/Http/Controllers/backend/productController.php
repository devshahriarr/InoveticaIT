<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;  
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        try {
            $allProducts = Product::all();
            return response()->json([
                'status' => 200,
                'data' => $allProducts,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            '_token' => 'required|max:250',
            'product_category' => 'required|max:6',
            'price' => 'required|between:0, 9999|numeric',
        ]);
        if ($validator->passes()) {
            $products = new Product;
            $products->product_name = $request->name;
            $products->product_slug = Str::slug($request->name);
            $products->secure_token = $request->_token;
            $products->product_desc = $request->desc;
            $products->product_img = $request->img;
            $products->product_tags = $request->pr_tags;
            $products->product_price = $request->price;
            $products->product_link = $request->pr_link;
            $products->status = 1;
            $products->product_cat_id = $request->product_category;

            if ($request->hasFile('image')) {
                $products->product_img = $this->handleImageUpload($request);
            }

            $products->save();

            return response()->json([
                'status' => 200,
                'message' => 'New Product added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => $validator->messages()
            ]);
        }
    }

    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($existingImage) {
            $this->deleteImage($existingImage);
        }

        // Use 'getClientOriginalExtension' to get the actual file extension
        $file = $request->file('categoryImage');
        $extension = $file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $file->move(public_path('uploads/products'), $imageName);

        return $imageName;
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $products = Product::orderByDesc('id')->with('varient')->get();


        // return view('backend.products.view', compact('products'));
        
        $allProducts = Product::all();
        
        return view('backend.body.storeManagement.product.productList', compact('allProducts'));
        // return view('backend.body.storeManagement.Product.productList' compact('allProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $products = Product::findOrFail($id);
            // dd($products);
            return response()->json([
                'status' => 200,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve Product data'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        
        // $products = Product::findOrFail($request->id);
        // $products->product_name = $request->name;
        // $products->product_cat_id = $request->product_category;
        // $products->product_price = $request->price;
        // $products->product_link = $request->pr_link;
        // $products->product_tags = $request->pr_tags;
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('uploads/product'), $filename);
        //     $products->image = $filename;
        // }
        // $products->save();

        // return response()->json([
        //     'status' => 200,
        //     'success' => 'Team member updated successfully.'
        // ]);
        
        try {
            $products = Product::findOrFail($id);

            $products->product_name = $request->name;
            $products->product_cat_id = $request->product_category;
            $products->product_price = $request->price;
            $products->product_link = $request->pr_link;
            $products->product_tags = $request->pr_tags;

            if ($request->hasFile('image')) {
                $products->image = $this->handleImageUpload($request, $products->image);
            }

            $products->save();

            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Team Member not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.dddddd',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            $products = Product::findOrFail($id);

            if ($products->image) {
                $this->deleteImage($products->image);
            }

            $products->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Team Member Deleted Successfully',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Team Member not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
    public function changeStatus($prId){

        $products = Product::findOrFail($prId); // Find the category by ID

        // dd($catId);
        $newStatus = $products->status == 0 ? 1 : 0;
        $products->update([
            'status' => $newStatus
        ]);
        return response()->json([
            'status' => 200,
            'newStatus' => $newStatus,
            'message' => 'Status Changed Successfully',
        ]);
        
    }

    private function deleteImage($imageName)
    {
        $imagePath = public_path('uploads/products/') . $imageName;

        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                \Log::error('Failed to delete image: ' . $imagePath);
            }
        }
    }
}
