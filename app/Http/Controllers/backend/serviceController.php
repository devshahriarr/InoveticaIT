<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
// use Log;
// use Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        // dd($services);
        return response()->json($services, 200);
        // return view('backend.body.service.service', compact('services'));
    }
    public function find($id)
    {
        // dd($id);
        
        try {
            $service = Service::find($id);
            if (!$service) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Service not found!',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'data' => $service,
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching service: " . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(), // Only for debugging
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
        // dd($request);
        $request->validate([
            '_token' => 'required|max:240',
            'service_name' => 'required|max:100',
            'service_cat' => 'required|max:100',
            'service_desc' => 'required|max:5000',
            'service_price' => 'required|max:100',
            'service_tags' => 'max:100',
            'service_img' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);
        $services = new Service;
        if ($request->service_img) {

            $image_name = rand() . '.' . $request->service_img->extension();
            $request->service_img->move(public_path('uploads/service/service_img/'), $image_name);
            $services->service_img = $image_name;
        }
        $services->service_name = $request->service_name;
        $services->service_slug = Str::slug($request->service_name);
        $services->token = $request->_token;
        $services->service_desc = $request->service_desc;
        $services->service_price = $request->service_price;
        $services->service_tags = $request->service_tags;
        $services->status = 0;
        $services->service_cat_id = $request->service_cat;
        $services->save();
        return back()->with('success', 'Category Successfully Saved');
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
