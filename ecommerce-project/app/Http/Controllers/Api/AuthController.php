<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signUp(Request $request) {
      
        try{
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:50|unique:users,email',
                'password' => 'required|min:7|max:50',
            ]);

            if($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'invalid user credentials',
                    'errors' => $validate->errors(),
                ], 401);
            }

            $user_info = $validate->validated();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            echo $user;

            Auth::login($user); //right?

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    
    }

    public function logIn(Request $request) {
        try{
            $validate = Validator::make($request->all(), [
                'email' => 'required|email|max:50',
                'password' => 'required|min:7|max:50',
            ]);

            if($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'invalid user credentials',
                    'errors' => $validate->errors(),
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            
            return response()->json([
                'status' => true,
                'message' => 'User successfully logged in',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200); 

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout() {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ]);
    }
}
