<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\PortfolioCategoryRequest;
use Validator;
class PortfolioCategoryController extends Controller
{
    public function index()
    {
        // return view('backend.body.service.service_category');
        $categories = PortfolioCategory::all();
        // dd($categories->all());
        return view('backend.body.portfolio.category', compact('categories'));
    }

    public function store(PortfolioCategoryRequest $request)
    {
        // dd($request);
        try {
            $category = new PortfolioCategory;
            $category->categoryName = $request->categoryName;
            $category->slug = Str::slug($request->categoryName);
            $category->status = 1;

            if ($request->hasFile('categoryImage')) {
                $category->image = $this->handleImageUpload($request);
            }

            $category->save();

            return response()->json([
                'status' => 200,
                'message' => 'Portfolio Category added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occured.',
            ], 500);
        }
    }
}
