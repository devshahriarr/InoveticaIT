<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ServiceCatRequest;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('backend.body.service.service_category');
        $categories = ServiceCategory::all();
        return view('backend.body.service.service_category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceCatRequest $request)
    {
        // dd($request);
        try {
            $category = new ServiceCategory;
            $category->categoryName = $request->categoryName;
            $category->slug = Str::slug($request->categoryName);
            $category->status = 1;

            if ($request->hasFile('categoryImage')) {
                $category->image = $this->handleImageUpload($request);
            }

            $category->save();

            return response()->json([
                'status' => 200,
                'message' => 'Service Category added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occured.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $categories = ServiceCategory::all();
            return response()->json([
                'status' => 200,
                'data' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
    public function find($id)
    {
        try {
            $categories = ServiceCategory::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $categories = ServiceCategory::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => $categories,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Service Category not found.',
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
    public function update(ServiceCatRequest $request, $id)
    {
        try {
            $categories = ServiceCategory::findOrFail($id);
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
    /**
     * Remove the specified Image from storage.
     */


    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($existingImage) {
            $this->deleteImage($existingImage);
        }

        // Use 'getClientOriginalExtension' to get the actual file extension
        $file = $request->file('categoryImage');
        $extension = $file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $file->move(public_path('uploads/service/category'), $imageName);

        return $imageName;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categories = ServiceCategory::findOrFail($id);

            if ($categories->image) {
                $this->deleteImage($categories->image);
            }

            $categories->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Service Category Deleted Successfully',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Service Category not found.',
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
        $imagePath = public_path('uploads/service/category/') . $imageName;

        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                \Log::error('Failed to delete image: ' . $imagePath);
            }
        }
    }
    public function changeStatus($catId){

        $category = ServiceCategory::findOrFail($catId); // Find the category by ID

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
}
