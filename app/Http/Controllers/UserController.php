<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(Request $request,$id){
    return response()->json(["massege"=>"done","data"=>User::all()->where('id',$request->id)]);
    }

    public function update(Request $request,$id){

        $user = User::where('id',$id)->first();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->logo = $request->logo;
            $user->save();
            //return $request->all();

        return response()->json(["massege"=>"done","data"=>$user]);

    }
}
