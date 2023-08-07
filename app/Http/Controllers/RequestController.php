<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function projectDetails(Request $request, $project_id, $form_id, $request_id=null){
       // $project = Project::with('requests')->find($project_id);
        $project = Project::select('start_date','end_date','project_name','location')
        ->where('id',$project_id)->first();

        $form = Form::find($form_id);
        // $project = [$project->start_date,
        // $project->end_date,
        // $project->project_name,
        // $project->location];
        //dd($project->requests);


                //هنا لو تتذكر الطريقة البدائية اللي كتبت فيها
        $version_number=1;
        if ($request_id)
        {
            $request = ModelsRequest::where('id',$request_id)->first();
            $version_number=count($request->versions)+1;
        }
        //dd($project->load('requests'));

        $count_request= count($project->requests)+1;
        unset($project->requests);

        return Response()->json([
            'massege'=>'done',
            "project_data"=> $project,
            'order_number'=>$form->code.'#'.$count_request,
            'version_number'=>$version_number,
            //'logos'

        ]);
    }
}
