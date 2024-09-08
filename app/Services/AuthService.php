<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(Request $request) {
        $errors = array();
        if ($request->input('email') == '') {
            $errors['emailRequired'] = true;
        } else {
            $errors['emailRequired'] = false;
        }
        if ($request->input('password') == '') {
            $errors['passwordRequired'] = true;
        } else {
            $errors['passwordRequired'] = false;
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['succeed' => true, 'user' => Auth::user()]);
        }
        return response()->json(['succeed' => false, 'errors' => $errors]);
    }

    public function register(Request $request) {
        if ($request->input('password') === $request->input('confirm_password')) {
            try {
                $user = new User();
                $user->name = $request->input('name');
                $user->password = bcrypt($request->input('password'));
                $user->email = $request->input('email');
                $user->save();
                return response()->json(['succeed' => true]);
            } catch (\Exception $exception) {
                return response()->json(['succeed'=> false, 'msg' => $exception->getMessage()]);
            }
        }
        return response()->json(['succeed' => false]);
    }

    public function logout() {
        Auth::logout();
    }

    public function getAuthenticatedUser() {
        if (Auth::check()) {
            return response()->json(Auth::user());
        }
        return response()->json(null);
    }
}
