<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Response;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function show(Request $request, $version_id){
        $type = $request->header('type');
        $data = Answer::where('version_id', $version_id)
        ->whereHas('form_question',function($query)use($type){
            $query->where('q_type',$type);
        })->get();
        if($type=='res_question'){$rate = Response::where('version_id',$version_id)
        ->latest()->first();
        $data->push(['rate'=>$rate->rate??null]);}


        return response()->json([
            'message' => 'done',
             'data'=> $data,
            ]);



    }
}
