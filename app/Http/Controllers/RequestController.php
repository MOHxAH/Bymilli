<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Project;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function projectDetails(Request $request, $project_id, $form_id){
       // $project = Project::with('requests')->find($project_id);
        $project = Project::select('start_date','end_date','project_name','location')
        ->where('id',$project_id)->first();

        $form = Form::find($form_id);
        // $project = [$project->start_date,
        // $project->end_date,
        // $project->project_name,
        // $project->location];

        $count_request= count($project->requests)+1;

        return Response()->json([
            'massege'=>'done',
            "date"=> $project,
            'order_number'=>$form->code.'#'.$count_request,


        ]);
    }
}
