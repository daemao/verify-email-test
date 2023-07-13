<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerifyRequest;
use App\Models\User;
use Carbon\Carbon;

class EmailVerifyController extends Controller
{
    public function index(EmailVerifyRequest $request){
        $formData = $request->only(['email','verify_code']);
        $user = User::where('email',$formData['email'])->where('verify_code',$formData['verify_code'])->firstOrFail();
        if($user->email_verified_at){
            abort(401,'Email already verified');
        }
        $user->email_verified_at = Carbon::now();
        $user->verify_code=null;
        $user->save();
        return response(['status'=>'success']);
    }
}
