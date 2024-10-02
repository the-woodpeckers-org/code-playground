<?php

namespace App\Services;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Responses\APIResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        }
        throw new NotFoundHttpException('User not found!');
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
            return response()->json(['message' => 'User register successfully!']);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
        throw new ConflictHttpException('User already exists!');
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getAuthenticatedUser()
    {
        if (Auth::check()) {
            return response()->json(['user' => Auth::user()]);
        }
        throw new NotFoundHttpException('User not found!');
    }
}
