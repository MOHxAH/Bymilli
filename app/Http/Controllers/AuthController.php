<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessTokenFactory;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    //use RegistersUsers;

    //
    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'phone_number' => ['required', 'string','unique:users'],
                //here
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'logo' => $request->logo,
            'phone_number' => $request->phone_number,
            'user_type' => $request->user_type

         ]);
         event(new Registered($user));
        // $user = User::create([
        //          'full_name' => $request->full_name,
        //          'email' => $request->email,
        //          'password' => Hash::make($request->password),
        //          'logo' => $request->logo,
        //          'phone_number' => $request->phone_number,
        //          'user_type' => $request->user_type

        //      ])->sendEmailVerificationNotification();
        //event(new Registered($user));

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            //'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user_type'=> $user->user_type,
            'user_id'=> auth()->id(),
        ], 200);

    }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'sometimes|required|email',
                'password' => 'required',
                'phone_number' => ['sometimes', 'string'],
                //and here
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $credentials = $request->only(['password']);
            $email = $request->get('email');
            $phone = $request->get('phone_number');

            if (!empty($email)) {
                $credentials['email'] = $email;
            } elseif (!empty($phone)) {
                $credentials['phone_number'] = $phone;
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email or Phone number is required.',
                ], 401);
            }

            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized.',
                ], 401);
            }

        $user = Auth::user();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user_type'=> $user->user_type,
            'user_id'=> auth()->id(),

        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'true',
            'message' => 'Successfully logged out',
        ]);
    }
    public function unAuth()
    {
        return response()->json([
            'status' => 'false',
            'message' => 'the user is unAuthnticated',
            'code'=>'401'
        ],401);
    }
}
