<?php

namespace App\Services;

use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Jobs\SendEmail;
use App\Mail\MailNotify;
use App\Models\Password_Reset_Tokens;
use App\Models\User;
use App\Utils\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{
    public function login(LoginFormRequest $request): array
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return ['user' => $user, 'token' => $token];
        }
        return throw new BadRequestHttpException('Unauthorized');
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
            return ['message' => 'User register successfully!'];
        } catch (\Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
        throw new ConflictHttpException('User already exists!');
    }

    public function logout(): string
    {
        return 'ok bro';
    }

    public function forgotPassword(ForgotPasswordFormRequest $request): array {
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            Password_Reset_Tokens::where('email', $user->email)->delete();
            $passwordResetToken = new Password_Reset_Tokens();
            $passwordResetToken->fill([
                'email' => $user->email,
                'token' => Token::generatePasswordToken(),
                'created_at' => Carbon::now()
            ]);
            $passwordResetToken->save();
            Mail::to($passwordResetToken->email)->send(new MailNotify($passwordResetToken));
            return ['message' => 'successfully', 'passwordResetToken' => $passwordResetToken];
        }
        return throw new BadRequestHttpException('User not found!');
    }

    public function resetPassword(ResetPasswordFormRequest $request): array {
        $token = Password_Reset_Tokens::where('token', $request->input('token'))->first();
        if ($token) {
            $user = $token->user();
            if ($user) {
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
                Password_Reset_Tokens::where('token', $request->input('token'))->delete();
                return ['message' => 'Change password successfully!'];
            }
        }
        return throw new BadRequestHttpException("Can't verify token!");
    }

    public function getAuthenticatedUser(Request $request): array
    {
        return User::where('id', $request->user()->id)->first();
    }
}
