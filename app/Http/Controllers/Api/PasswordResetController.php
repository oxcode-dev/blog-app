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
            $code = $user->sendPasswordResetNotification();
            $data = [
                'status' => 'success',
                'message' => 'email sent successfully',
                'code' => $code,
            ];
        } else {
            $data = [
                'status' => 'failed',
                'message' => 'email does not exist',
            ];
        }

        return response()->json($data, 201);
    }

}
