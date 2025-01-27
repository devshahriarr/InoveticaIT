<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.body.storeManagement.productCategory.category');
        // $product_categories = ProductCategory::all();
        // dd($product_categories);
        // return view('backend.body.storeManagement.productCategory.category', compact('product_categories'));
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

            // if ($request->categoryImage) {
            //     // dd( $request->categoryImage);
            //     $imageName = rand() . '.' . $request->categoryImage->extension();
            //     $request->categoryImage->move(public_path('uploads/product/category'), $imageName);
            //     // dd( $imageName);
            //     $category->image = $imageName;
            //     // dd( $category->image);
            // }
            if ($request->hasFile('categoryImage')) {
                $category->image = $this->handleImageUpload($request);
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
    public function show()
    {
        $categories = ProductCategory::all();
            return response()->json([
                "status" => 200,
                "data" => $categories
        ]);
        // try {
        //     $categories = ProductCategory::all();
        //     return response()->json([
        //         'status' => 200,
        //         'data' => $categories,
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'An unexpected error occurred.',
        //     ], 500);
        // }
    }
    public function changeStatus($catId){

        $category = ProductCategory::findOrFail($catId); // Find the category by ID

        // dd($catId);
        $newStatus = $category->status == 0 ? 1 : 0;
        $category->update([
            'status' => $newStatus
        ]);
        return response()->json([
            'status' => 200,
            'newStatus' => $newStatus,
            'message' => 'Status Changed Successfully',
        ]);
        
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $categories = ProductCategory::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => $categories,
                'message' => 'Product Category Updated Succesfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Category not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categories = ProductCategory::findOrFail($id);
            $categories->categoryName = $request->categoryName;
            $categories->slug = Str::slug($request->categoryName);

            if ($request->hasFile('categoryImage')) {
                $categories->image = $this->handleImageUpload($request, $categories->image);
            }
            
            $categories->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team member updated successfully.',
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

    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($existingImage) {
            $this->deleteImage($existingImage);
        }

        // Use 'getClientOriginalExtension' to get the actual file extension
        $file = $request->file('categoryImage');
        $extension = $file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $file->move(public_path('uploads/product/category'), $imageName);

        return $imageName;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $categories = ProductCategory::findOrFail($id);

            if ($categories->image) {
                $this->deleteImage($categories->image);
            }

            $categories->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Product Category Deleted Successfully',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Category not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
    private function deleteImage($imageName)
    {
        $imagePath = public_path('uploads/product/category') . $imageName;

        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                \Log::error('Failed to delete image: ' . $imagePath);
            }
        }
    }
}
