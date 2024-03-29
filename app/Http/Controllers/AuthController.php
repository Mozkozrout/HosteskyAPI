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
        $userDetails = null;
        if($user -> userDetails) $userDetails = $user -> userDetails;

        return $this -> success([
            'user' => $user,
            'user_details' => $userDetails,
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
            'account_type' => $request -> account_type,
        ]);
        return $this -> success([
            'user' => $user,
            'token' => $user -> createToken('API Token of ' . $user -> name) -> plainTextToken
        ]);
    }

    public function logout(){
        Auth::user() -> currentAccessToken() -> delete();

        return $this -> success([
            'message' => 'Byli jste úspěšně odhlášeni'
        ]);
    }

    public function getUser(){
        $user = Auth::user();
        $userDetails = null;
        if($user -> userDetails) $userDetails = $user -> userDetails;

        return $this -> success([
            'user' => $user,
            'user_details' => $userDetails
        ]);
    }

    public function getAllUsers(){
        $user = Auth::user();
        $allUsers = null;
        if($user -> account_type == 2){
            $allUsers = User::leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->select('users.name','users.surname','users.tel','users.email', 'user_details.*')
            ->get();
        }

        return $this -> success([
            'allUsers' => $allUsers
        ]);
    }
}
