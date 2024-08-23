<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Validator;

class TeamController extends Controller
{
    public function index()
    {
        return view('backend.body.teamManagement.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'position' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->passes()) {
            $team = new Team;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/team/'), $imageName);
                $team->image = $imageName;
            }

            $team->name = $request->name;
            $team->position = $request->position;
            $team->status = 1;
            $team->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team member added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages()
            ]);
        }
    }



    public function getData()
    {
        $teamMembers = Team::all();
        return response()->json([
            'status' => 200,
            'data' => $teamMembers
        ]);
    }
    public function edit($id)
    {
        $teamMember = Team::findOrFail($id);
        if ($teamMember) {
            return response()->json([
                'status' => 200,
                'data' => $teamMember
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'No Data Found'
            ]);
        }
    }
    public function update(Request $request)
    {
        $teamMember = Team::findOrFail($request->id);
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/team/'), $filename);
            $teamMember->image = $filename;
        }
        $teamMember->save();

        return response()->json([
            'status' => 200,
            'success' => 'Team member updated successfully.'
        ]);

    }

    // public function destroy($id)
    // {
    //     $teamMember = Team::findOrFail($id);
    //     // dd($teamMember->all());

    //     // Ensure the user is authorized to delete this team member
    //     $this->authorize('delete', $teamMember);

    //     if ($teamMember->image) {
    //         $previousImagePath = public_path('uploads/team/') . $teamMember->image;
    //         if (file_exists($previousImagePath)) {
    //             if (!unlink($previousImagePath)) {
    //                 // Log the error if unlink fails
    //                 \Log::error('Failed to delete image: ' . $previousImagePath);
    //             }
    //         }
    //     }
    //     $teamMember->delete();
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Team Member Deleted Successfully',
    //     ]);
        
    //     // $teamMember = Team::find($request->id);
    //     // $teamMember->delete();

    //     // return response()->json(['success' => 'Team member deleted successfully.']);
    // }

    public function destroy($id)
    {
        try {
            $teamMember = Team::findOrFail($id);
            if ($teamMember->image) {
                $previousImagePath = public_path('uploads/team/') . $teamMember->image;
                if (file_exists($previousImagePath)) {
                    if (!unlink($previousImagePath)) {
                        return response()->json([
                            'status' => 500,
                            'message' => 'Failed to delete associated image.',
                        ], 500);
                    }
                }
            }

            $teamMember->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Team Member Deleted Successfully',
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

}
