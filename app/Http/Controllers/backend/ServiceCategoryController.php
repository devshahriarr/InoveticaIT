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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

            if ($request->hasFile('image')) {
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
        $categories = ServiceCategory::all();
        return view('backend.body.service.service_category', compact('categories'));
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
