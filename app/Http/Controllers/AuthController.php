<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request){
        $request -> validated($request -> all());

        if(!Auth::attempt($request -> only(['email', 'password']))){
            return $this -> error('', 'Špatné přihlašovací údaje', 401);
        }

        $user = User::where('email', $request -> email) -> first();

        return $this -> success([
            'user' => $user,
            'token' => $user -> createToken('API Token of ' . $user -> name) -> plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){
        $request -> validated($request -> all());

        $user = User::create([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'tel' => $request -> tel,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);
        return $this -> success([
            'user' => $user,
            'token' => $user -> createToken('API Token of ' . $user -> name) -> plainTextToken
        ]);
    }

    public function logout(){
        return response() -> json('Logout');
    }
}
