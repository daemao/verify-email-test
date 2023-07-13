<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(LoginRequest $request){
        $formData = $request->only(['email','password']);
        if(!Auth::attempt($formData)){
            abort(401,'User with given credentials not found ');
        }

        $user = User::where('email',$formData['email'])->whereNotNull('email_verified_at')->first();
        if(!$user->email_verified_at){
            abort(401,'Email not verified');
        }
        return ['token'=>$user->createToken('auth_token')];
    }
}
