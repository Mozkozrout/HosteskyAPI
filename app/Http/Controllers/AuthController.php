<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
        return response() -> json('Login');
    }

    public function register(StoreUserRequest $request){
        return response() -> json('Register');
    }

    public function logout(){
        return response() -> json('Logout');
    }
}
