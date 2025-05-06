<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Blogs;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('backend.body.blogs.index');
         
    }
    public function allPost()
    {
        try {
            $allblog = Blogs::all();
            // dd($allblog);
            return response()->json([
                'status' => 200,
                'data' => $allblog,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
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
        // @dd($request);
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            // '_token' => 'required|max:250',
            'blog_category_id' => 'required|max:6',
            // 'price' => 'sometimes|between:0, 9999|numeric',
            'post_tags' => 'string',
        ]);
        if ($validator->passes()) {
            $blog = new Blogs;
            $blog->title = $request->name;
            $blog->slug = Str::slug($request->name);
            // $blog->secure_token = $request->_token;
            $blog->secure_token = 'here will be the token';
            $blog->post = $request->desc;
            $blog->img = $request->img;
            $blog->tags = $request->pr_tags;
            // $blog->blog_price = $request->price;
            $blog->extra_link = $request->post_link;
            // $blog->status = 'active';
            $blog->post_cat_id = $request->blog_category_id;

            if ($request->hasFile('image')) {
                $blog->blog_img = $this->handleImageUpload($request);
            }

            $blog->save();

            return response()->json([
                'status' => 200,
                'message' => 'Post Created Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => $validator->messages()
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
