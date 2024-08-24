<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;

class TeamController extends Controller
{
    public function index()
    {
        return view('backend.body.teamManagement.index');
    }

    public function store(TeamRequest $request)
    {
        try {
            $team = new Team;
            $team->name = $request->name;
            $team->position = $request->position;
            $team->status = 1;

            if ($request->hasFile('image')) {
                $team->image = $this->handleImageUpload($request);
            }

            $team->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team member added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occured.',
            ], 500);
        }
    }

    public function getData()
    {
        try {
            $teamMembers = Team::all();
            return response()->json([
                'status' => 200,
                'data' => $teamMembers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $teamMember = Team::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => $teamMember,
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

    public function update(TeamRequest $request, $id)
    {
        try {
            $teamMember = Team::findOrFail($id);

            $teamMember->name = $request->name;
            $teamMember->position = $request->position;

            if ($request->hasFile('image')) {
                $teamMember->image = $this->handleImageUpload($request, $teamMember->image);
            }

            $teamMember->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team member updated successfully.',
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

    public function destroy($id)
    {
        try {
            $teamMember = Team::findOrFail($id);

            if ($teamMember->image) {
                $this->deleteImage($teamMember->image);
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

    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($existingImage) {
            $this->deleteImage($existingImage);
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/team/'), $imageName);

        return $imageName;
    }

    private function deleteImage($imageName)
    {
        $imagePath = public_path('uploads/team/') . $imageName;

        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                \Log::error('Failed to delete image: ' . $imagePath);
            }
        }
    }
}
