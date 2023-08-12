<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Response;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{


    public function createResponse(Request $request, $version_id){

        DB::beginTransaction();
        try{
            $newResponse = Response::create([
                'version_id'=>$version_id,
                'rate'=> $request->rate,
            ]);
            foreach($request->questions as $question){
                //dd($question);
                $newAnswer = Answer::create([
                    'version_id'=>$version_id,
                    'form_question_id'=>$question['form_question_id'],
                    'user_id'=>auth()->id(),
                    'content'=>$question['content'],
                ]);
            }


            DB::commit();
            return response()->json(['message' => 'Response created successfully.']);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);}

    }


    }
