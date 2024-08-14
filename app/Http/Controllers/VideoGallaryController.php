<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VideoGallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoGallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.page.video-gallery');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $video = new VideoGallary;
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/video-gallery/'), $imageName);
                $video->url = $imageName;
            }
            $video->title =  $request->title;
            $video->description = $request->description;
            $video->save();
            return response()->json([
                'status' => 200,
                'message' => 'Video Gallery Save Successfully',
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
        $video = VideoGallary::get();
        return response()->json([
            "status" => 200,
            "data" => $video
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $video = VideoGallary::findOrFail($id);
        if ($video) {
            return response()->json([
                'status' => 200,
                'video' => $video
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
            'title' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $gallery = VideoGallary::findOrFail($id);
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/video-gallery/'), $imageName);
                if ($gallery->url) {
                    $previousImagePath = public_path('uploads/video-gallery/') . $gallery->url;
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $gallery->url = $imageName;
            }
            $gallery->title =  $request->title;
            $gallery->description = $request->description;
            $gallery->save();
            return response()->json([
                'status' => 200,
                'message' => 'Video Gallery Update Successfully',
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
        $gallery = VideoGallary::findOrFail($id);
        if ($gallery->url) {
            $previousImagePath = public_path('uploads/video-gallery/') . $gallery->url;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $gallery->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Video Gallery Deleted Successfully',
        ]);
    }
}
