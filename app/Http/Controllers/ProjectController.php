<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
class ProjectController extends Controller
{
public function view(){
    return Project::paginate(5);
    }
public function viewAll(){
        return Project::all();
        }
public function show($id){
    $project= Project::find($id);
    return response()->json(["massege"=>"done","data"=>$project]);
}
public function store(Request $request)
{
    try {
        // Define validation rules for the input
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'consultant_name' => 'required|string|max:255',
            'consultant_email' => 'required|email|max:255',
            'contractor_name' => 'required|string|max:255',
            'contractor_email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'project_logo' => 'nullable|string|max:255',
            'project_description' => 'nullable|string',
            'location' => 'required|string|max:255',
        ]);

        // If validation fails, return error response with validation status code
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Create a new project using mass assignment
        $project = Project::create($request->all());

        // Return success response with created status code
        return response()->json(['message' => 'Project created successfully', 'data' => $project], 201);
    } catch (QueryException $e) {
        // Handle database query exceptions and return error response with server error status code
        return response()->json(['message' => 'An error occurred while processing your request'], 500);
    } catch (\Exception $e) {
        // Handle other exceptions and return error response with server error status code
        return response()->json(['message' => 'An unexpected error occurred'], 500);
    }
}
// public function destroy(Request $request){
//     Project::where("id",$request->id)->delete();
// }
public function destroy($id){
    Project::where("id",$id)->delete();
}
public function update(Request $request,$id){
    $project = Project::where('id',$id)->first();
    $project->project_name = $request->project_name;
        $project->save();
        //return $request->all();

    return response()->json(["massege"=>"done","data"=>$project]);

        //Project::where('user',$id)->update($request->all());






}
    }
