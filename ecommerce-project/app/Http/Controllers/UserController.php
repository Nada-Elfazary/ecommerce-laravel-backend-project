<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function show() {
        $user = Auth::user(); 

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        
        if($request->name == null){
            echo 'name null';
            $request['name'] =  $user->name;
        }

        if($request->email == null){
            echo 'thought email null';
            $request['email'] =  $user->email;
        }

        $affected = DB::table('users')->where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user = User::where('id', $user->id)->get()->first();
        echo $affected;
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }



   
}
