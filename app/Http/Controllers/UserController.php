<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function show(Request $request, $id)
{
    try {
        // Retrieve the user and their associated projects
        $user = User::with('project_users')->find($id);

        // Return the response with user's data and associated projects
        return response()->json([
            "message" => "Data retrieved successfully",
            "user" => new UserResource($user),
            //"user_projects" => $user->projects,UserResource::collection(
        ]);
    } catch (\Exception $e) {
        // Handle exceptions and return error response with server error status code
        return response()->json(['error' => 'An unexpected error occurred','errorM' => $e->getMessage()], 500);
    }
}
public function update(Request $request, $id)
{
    try {

        // Define validation rules for the input
        $validator = Validator::make($request->all(), [
            'full_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
        ]);

        // If validation fails, return error response with validation status code
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update user attributes if provided in the request
        if ($request->filled('full_name')) {
            $user->full_name = $request->full_name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('phone_number')) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->filled('logo')) {
            $user->logo = $request->logo;
        }

        // Save the updated user
        $user->save();

        // Return success response with updated status code
        return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
    } catch (\Exception $e) {
        // Handle exceptions and return error response with server error status code
        return response()->json(['message' => 'An unexpected error occurred'], 500);
    }
}


}


