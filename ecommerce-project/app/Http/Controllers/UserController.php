<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

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
        $user = User::find(1)->first(); //hardcoded for now, later Auth::user()

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,

        ]);
    }

    public function edit() {
        $user = User::find(1)->first(); //hardcoded for now, later Auth::user()

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,

        ]);
    }



   
}
