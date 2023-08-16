<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
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
    //     // Define validation rules for the input
    //     $validator = Validator::make($request->all(), [
    //         'project_name' => 'required|string|max:255',
    //         'owner_name' => 'nullable|string|max:255',
    //         'consultant_name' => 'nullable|string|max:255',
    //         'consultant_email' => 'nullable|email|max:255',
    //         'contractor_name' => 'nullable|string|max:255',
    //         'contractor_email' => 'nullable|email|max:255',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //         'project_logo' => 'nullable|file', //,max:2048'
    //         'project_description' => 'nullable|string',
    //         'location' => 'nullable|string|max:255',
    //     ]);

    //     // If validation fails, return error response with validation status code
    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
    //     }

        //$logo =null;
        if ($request->hasFile('project_logo')) {
            $file = $request->file('project_logo');
            $filename = date('YmdHi').$file->getClientOriginalName();
                        $file->move(public_path('images'), $filename);
        }

        $project = Project::create([
            'project_name' =>$request->project_name??null ,
            'owner_name' => $request->owner_name??null,
            'consultant_name' => $request->consultant_name??null,
            'consultant_email' => $request->consultant_email??null,
            'contractor_name' => $request->contractor_name??null,
            'contractor_email' => $request->contractor_email??null,
            'start_date' => $request->start_date??null,
            'end_date' => $request->end_date??null,
            'project_logo' => $filename,
            'project_description' => $request->project_description??null,
            'location' =>$request->location??null,


        ]);


        // Create a new project using mass assignment
        //$project = Project::create($request->all());
        //        $project->save();


        $projectuser = ProjectUser::create([
        'user_id' => auth()->id(),
        'project_id' => $project->id,
        'project_name'=>$project->project_name,

        ]);

        // Return success response with created status code
        return response()->json(['message' => 'Project created successfully', 'data' => $project,
    'user_type '=>auth()->user()->user_type], 201);
    } catch (QueryException $e) {
        // Handle database query exceptions and return error response with server error status code
        return response()->json(['message' => 'An error occurred while processing your request', 'error' => $e->getMessage()], 500);
    } catch (\Exception $e) {
        // Handle other exceptions and return error response with server error status code
        return response()->json(['message' => 'An unexpected error occurred','error' => $e->getMessage()], 500);
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
