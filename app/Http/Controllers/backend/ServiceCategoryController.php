<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('backend.pages.service.service_category');
        $categories = ServiceCategory::all();
        return view('backend.pages.service.service_category', compact('categories'));
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
        $request->validate([
            'categoryName' => 'required|max:100',
            'categoryImage' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $category = new ServiceCategory;
        if ($request->categoryImage) {

            $imageName = rand() . '.' . $request->categoryImage->extension();
            $request->categoryImage->move(public_path('uploads/service/categoryImage/'), $imageName);
            $category->image = $imageName;
        }
        
        $category->categoryName = $request->categoryName;
        $category->slug = Str::slug($request->categoryName);

        

        
        // dd($category->$image);
        $category->save();
        return back()->with('success', 'Category Successfully Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = ServiceCategory::all();
        return view('backend.pages.service.service_category', compact('categories'));
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
