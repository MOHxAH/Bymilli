<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Answer;
use App\Models\Response;
use App\Models\Version;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    };
    $submission = "";
    $time = Version::where('id',$version_id)->first()->created_at;

    $carbonCreated = Carbon::parse($time);

    $gre = $carbonCreated->format('Y-m-d');

    $cur = $carbonCreated->format('H:i');

    $hij = Hijri::ShortDateIndicDigits($time);

    $times =[
                 "gre"=>$gre,
                 "hij"=>$hij,
                 //"rem"=>$submission-Carbon::now(),
                 "cur"=>$cur,
    ];

        return response()->json([
            'message' => 'done',
            'data'=> $data,
            'rate'=>$rate->rate??null,
            'times'=>$times
            ]);



    }
}
