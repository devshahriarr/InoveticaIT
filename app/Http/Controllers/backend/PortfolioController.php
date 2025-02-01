<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.portfolio.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $portfolio = new Portfolio;
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/portfolio/'), $imageName);
                $portfolio->image_url = $imageName;
            }
            $portfolio->title =  $request->name;
            $portfolio->url = $request->url;
            $portfolio->description = $request->description;
            $portfolio->save();
            return response()->json([
                'status' => 200,
                'message' => 'portfolio Save Successfully',
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
    public function getData()
    {
        $portfolio = Portfolio::get();
        return response()->json([
            "status" => 200,
            "data" => $portfolio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio) {
            return response()->json([
                'status' => 200,
                'portfolio' => $portfolio
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Data Not Found"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $portfolio = Portfolio::findOrFail($id);
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/portfolio/'), $imageName);
                if ($portfolio->image_url) {
                    $previousImagePath = public_path('uploads/portfolio/') . $portfolio->image_url;
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $portfolio->image_url = $imageName;
            }
            $portfolio->title       = $request->name;
            $portfolio->url         = $request->url;
            $portfolio->description = $request->description;
            $portfolio->save();
            return response()->json([
                'status' => 200,
                'message' => 'portfolio Update Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->url) {
            $previousImagePath = public_path('uploads/portfolio/') . $portfolio->url;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $portfolio->delete();
        return response()->json([
            'status' => 200,
            'message' => 'portfolio Deleted Successfully',
        ]);
    }

    public function viewAll()
    {
        $images = Portfolio::all(); 

        if ($images->count() > 0) {
            return view('frontend.gallary', compact('images'));
        }

        return response()->json([
            'status' => 200,
            'message' => 'portfolio Image Not Found',
        ]);
    }
}
