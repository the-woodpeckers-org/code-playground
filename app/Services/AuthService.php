<?php

namespace App\Services;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['succeed' => true, 'user' => Auth::user()]);
        }
        return response()->json(['succeed' => false, 'user' => null]);
    }

    public function register(RegisterFormRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->password = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->birthday = $request->input('birthday');
            $user->gender = $request->input('gender');
            $user->phone_number = $request->input('phone_number');
            $user->save();
            return response()->json(['succeed' => true]);
        } catch (\Exception $exception) {
            return response()->json(['succeed' => false, 'msg' => $exception->getMessage()]);
        }
        return response()->json(['succeed' => false]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getAuthenticatedUser()
    {
        if (Auth::check()) {
            return response()->json(Auth::user());
        }
        return response()->json(null);
    }
}
