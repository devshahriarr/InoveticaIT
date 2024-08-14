<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.page.team');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
        ]);

        if ($validator->passes()) {
            $team = new Team;
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/team/'), $imageName);
                $team->photo_url = $imageName;
            }
            $team->name =  $request->name;
            $team->position = $request->position;
            $team->bio = $request->bio;
            $team->save();
            return response()->json([
                'status' => 200,
                'message' => 'Team Save Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
    }

    public function getData()
    {
        $team = Team::all();
        return response()->json([
            "status" => 200,
            "data" => $team
        ]);
    }

    public function edit($id)
    {
        try {
            $team = Team::findOrFail($id);
            return response()->json([
                'status' => 200,
                'team' => $team
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve team data'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
        ]);

        if ($validator->passes()) {
            $team = Team::findOrFail($id);
            if ($request->image) {
                $imageName = rand() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/team/'), $imageName);
                if ($team->photo_url) {
                    $previousImagePath = public_path('uploads/team/') . $team->photo_url;
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
                $team->photo_url = $imageName;
            }
            $team->name =  $request->name;
            $team->position = $request->position;
            $team->bio = $request->bio;
            $team->save();
            return response()->json([
                'status' => 200,
                'message' => 'Team Update Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        if ($team->photo_url) {
            $previousImagePath = public_path('uploads/team/') . $team->photo_url;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $team->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Team Deleted Successfully',
        ]);
    }
}
