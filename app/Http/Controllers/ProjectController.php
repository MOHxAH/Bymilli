<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
public function index(Request $request){
    return Project::all();
}
public function store(Request $request){

    //Project::create($request->all());
    //dd($request->all());

        $project = new Project;

        $project->owner_name = $request->owner_name;
        $project->consultant_name = $request->consultant_name;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->project_logo = $request->project_logo;
        $project->project_name = $request->project_name;

        $project->save();
      //  return response;
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
