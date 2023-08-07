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
        $user = Auth::user(); //hardcoded for now, later Auth::user()

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,

        ]);
    }

    public function edit(Response $response) {
        $user = Auth::user(); //hardcoded for now, later Auth::user()
        $affected = DB::table('users')->where('id', $user->id)->update(['name' => $response->name]);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,

        ]);
    }



   
}
