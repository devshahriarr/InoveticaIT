<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.page.galary');
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
            $gallery = new Gallary;
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/galary/'), $imageName);
                $gallery->url = $imageName;
            }
            $gallery->title =  $request->name;
            $gallery->description = $request->description;
            $gallery->save();
            return response()->json([
                'status' => 200,
                'message' => 'Gallery Save Successfully',
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
    public function view()
    {
        $galary = Gallary::get();
        return response()->json([
            "status" => 200,
            "data" => $galary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galary = Gallary::findOrFail($id);
        if ($galary) {
            return response()->json([
                'status' => 200,
                'galary' => $galary
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
            $gallery = Gallary::findOrFail($id);
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/galary/'), $imageName);
                if ($gallery->url) {
                    $previousImagePath = public_path('uploads/galary/') . $gallery->url;
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $gallery->url = $imageName;
            }
            $gallery->title =  $request->name;
            $gallery->description = $request->description;
            $gallery->save();
            return response()->json([
                'status' => 200,
                'message' => 'Gallery Update Successfully',
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
        $gallery = Gallary::findOrFail($id);
        if ($gallery->url) {
            $previousImagePath = public_path('uploads/galary/') . $gallery->url;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $gallery->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Gallery Deleted Successfully',
        ]);
    }

    public function viewAll()
    {
        $images = Gallary::all(); 

        if ($images->count() > 0) {
            return view('frontend.gallary', compact('images'));
        }

        return response()->json([
            'status' => 200,
            'message' => 'Gallery Image Not Found',
        ]);
    }
}
