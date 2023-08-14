<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequestResource;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

//use Laravel\Sanctum\HasApiTokens;

class RequestController extends Controller
{
    public function projectDetails(Request $request, $project_id, $form_id, $request_id = null)
    {

        $project = Project::select('start_date', 'end_date', 'project_name', 'location')
            ->where('id', $project_id)->first();

        $form = Form::find($form_id);

        //هنا لو تتذكر الطريقة البدائية اللي كتبت فيها
        $version_number = 1;
        if ($request_id) {
            $request = ModelsRequest::where('id', $request_id)->first();
            $version_number = count($request->versions) + 1;
        }

        $count_request = count($project->requests) + 1;
        unset($project->requests);

        return Response()->json([
            'massege' => 'done',
            "project_data" => $project,
            'order_number' => $form->code . '#' . $count_request,
            'version_number' => $version_number,
            //'logos'

        ]);
    }

    public function createRequest(Request $Hrequest, $project_id, $form_id, $request_id = null)
    {
        $questionData = [
            'questions' => []
        ];

        foreach ($Hrequest->all() as $key => $question) {
            if (in_array($key, ['7', '16', '19'])) {
                $object = [
                    'form_question_id' => $key,
                    'files' => $question
                ];
            } else {
                $object = [
                    'form_question_id' => $key,
                    'content' => $question
                ];
            }

            $questionData["questions"][] = $object;
        }
        // return $questionData;
        //return $Hrequest->file('key')->move(public_path('images'), 'myfile.png');
        $validation = Validator::make($questionData, [
            'questions' => 'required|array',
            'questions.*.form_question_id' => 'required|integer',
            'questions.*.content' => 'exclude_if:questions.*.form_question_id,7,16,19|required|string',
            'questions.*.files' => 'exclude_unless:questions.*.form_question_id,7,16,19|required|file',

        ]);
        if($validation->fails()){
        return response()->json(["status"=>"false",
                "massege"=>"bad request"]);}
        DB::beginTransaction();
        try {

            if ($request_id == null) {
                $project = Project::find($project_id);
                $form = Form::find($form_id);
                $req_num = count($project->requests);
                $newRequest = ModelsRequest::create([
                    'project_id' => $project_id,
                    'user_id' => auth()->id(),
                    'form_id' => $form_id,
                    'code' => $form->code . '#' . $req_num + 1,
                ]);
                $newVersion = Version::create([
                    'request_id' => $newRequest->id,
                    'version_number' => 1,
                ]);
                foreach ($Hrequest->all() as $key => $question) {

                    $newAnswer = Answer::create([
                        'version_id' => $newVersion->id,
                        'form_question_id' => $key,
                        'user_id' => auth()->id(),
                        'content' => $question,
                    ]);
                }
            } else {
                $request = ModelsRequest::where('id', $request_id)->first();
                $newVersion = Version::create([
                    'request_id' => $request->id,
                    'version_number' => $request->versions()->count() + 1,
                ]);

                foreach ($Hrequest->all() as $key => $question) {

                    $newAnswer = Answer::create([
                        'version_id' => $newVersion->id,
                        'form_question_id' => $key,
                        'user_id' => auth()->id(),
                        'content' => $question,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['message' => 'Request created successfully.']);

        } catch (\Exception $e) {
            DB::rollBack();
            //dd($request->all());
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function viewUneval($project_id)
    {
        $requests = ModelsRequest::where('project_id', $project_id)
            ->whereHas("versions", function ($query) {
                $query->orderByDesc('created_at')
                    ->whereHas("answers", function ($query) {
                        $query->whereHas("form_question", function ($query) {
                            $query->whereHas("question", function ($query) {
                                $query->whereIn('content', ['tasks', 'start_job_date', 'end_job_date', 'work_major']);
                            });
                        });
                    });
            })->with('versions.answers.form_question.question')->get();
        return response()->json([
            'message' => 'done',
            'data' => RequestResource::collection($requests),
        ]);
    }

    // $requests = ModelsRequest::where('project_id', $project_id)
    // ->whereHas('versions', function ($query) {
    //     $query->orderByDesc('created_at')->take(1)
    //         ->whereHas('answers.form_questions.questions', function ($q) {
    //             $q->whereIn('content', ['tasks', 'start_job_date', 'end_job_date']);


    public function viewEval(Request $request, $project_id)
    {
        $requests = ModelsRequest::where('project_id', $project_id)
            ->whereHas("versions", function ($query) {
                $query->orderByDesc('created_at')
                    ->whereHas("answers", function ($query) {
                        $query->whereHas("form_question", function ($query) {
                            $query->whereHas("question", function ($query) {
                                $query->whereIn('content', ['tasks', 'start_job_date', 'end_job_date']);
                            });
                        });
                    })->whereHas("response");
            })->with([
                    'versions' => function ($query) {
                        $query->with(['response', 'answers.form_question.question']);
                    }
                ])
            ->get();

        return response()->json([
            'message' => 'done',
            'data' => RequestResource::collection($requests),
        ]);
    }
}
