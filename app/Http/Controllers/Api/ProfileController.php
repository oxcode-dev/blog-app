<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends BaseController
{
    public function updatePassword(Request $request)//: \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = $request->user('api');

        if(!$user || !Hash::check($data['current_password'], $user->password)) {
            return $this->sendError([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect.'
            ]);       
        }

        $user->update(['password' =>  bcrypt($data['password'])]);

        return $this->sendResponse('success', "Successfully changed user password.");
    }

    public function updateProfile(Request $request)//: \Illuminate\Http\JsonResponse
    {
        $user =  $request->user('api');

        $data  = $request->validate([
            'name' => 'sometimes',
            'email' => [
                'request',
                Rule::unique('users')->ignore($user->id),
            ],
            // 'phone' => 'sometimes',
        ]);

        $user->name = e($data['name']);
        $user->email = e($data['email']);
        // $user->phone = e($data['phone']);

        $user->save();


        return $this->sendResponse($user->fresh(), "Successfully updated user profile.");

    }

    public function deleteAccount()//: JsonResponse
    {
        User::find(auth()->user()->id)?->delete();

        return $this->sendResponse([], "Account deleted successfully.");
    }
}
