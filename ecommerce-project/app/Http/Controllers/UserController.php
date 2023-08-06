<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function signUp() {
      
        $yy = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|min:7|max:50',
        ]);

      
    


        return;
    }

    public function logIn() {
        return;
    }
}
