<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Mail\VerifyCodeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function index(SignUpRequest $request){
        $formData = $request->only(['email','password']);
        $user = new User(['email'=>$formData['email']]);
        $user->password = Hash::make($formData['password']);
        $user->verify_code=Str::random(6);
        $user->save();
        Mail::to('yersultan.nagashtay@nu.edu.kz')->send(new VerifyCodeEmail($user->verify_code));//this is my personal email, since using sandbox mailgun
        return response()->json(['status'=>'Verify code was sent to your email'],201);
    }
}
