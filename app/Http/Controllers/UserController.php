<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(Request $request,$id){
    return response()->json(["massege"=>"done","data"=>User::find($id)]);
    }

    public function update(Request $request,$id){

        $user = User::where('id',$id)->first();
        $user->full_name = $request->full_name ?? $user->full_name;
        $user->email = $request->email ?? $user->email;
        $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->logo = $request->logo ?? $user->logo;
            $user->save();
            //return $request->all();

        return response()->json(["massege"=>"done","data"=>$user]);

    }
}
