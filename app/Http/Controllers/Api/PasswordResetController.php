<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordResetController extends BaseController
{
    public function forgot(Request $request)//: \Illuminate\Http\JsonResponse
    {
        $data = $request->validate(['email' => 'required|email']);

        if (User::where('email', $data['email'])->exists()) {
            $user = User::where('email', $data['email'])->firstOrFail();
            $user->sendPasswordResetNotification();

            return $this->sendResponse(
                'email sent successfully', 
                'Forgot Password Request.'
            );
        } else {
            return $this->sendError('email does not exist.', ['error'=>'failed']);
        }
    }

}
