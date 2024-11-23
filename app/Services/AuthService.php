<?php

namespace App\Services;

use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Mail\MailNotify;
use App\Mail\MailVerifyEmailNotify;
use App\Models\EmailVerifyToken;
use App\Models\Password_Reset_Tokens;
use App\Models\User;
use App\Models\ProfileCompany;
use App\Utils\Constants\Status;
use App\Utils\Token;
use App\Utils\Constants\Role;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Company;
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

    public function forgotPassword(ForgotPasswordFormRequest $request): array
    {
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

    public function verifyPasswordResetPassword(Request $request): array
    {
        $existToken = Password_Reset_Tokens::where('token', $request->input('token'))->first();
        if ($existToken) {
            return ['message' => 'Password reset token is valid', 'isValid' => true];
        }
        throw new BadRequestHttpException($request->input('token') . ' ');
    }

    public function resetPassword(ResetPasswordFormRequest $request): array
    {
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

    public function sendVerificationEmail(Request $request)
    {
        $currentUser = User::find($request->user()->id);
        $token = substr(str_shuffle("0123456789"), 0, 5);
        $emailVerifyToken = EmailVerifyToken::where('email', $currentUser->email)->first();
        if ($emailVerifyToken) {
            $emailVerifyToken->delete();
        }
        $emailVerifyToken = new EmailVerifyToken();
        $emailVerifyToken->fill([
            'email' => $currentUser->email,
            'token' => $token,
            'expires_at' => Carbon::now()->addDays(1)
        ]);
        $emailVerifyToken->save();
        Mail::to($currentUser->email)->send(new MailVerifyEmailNotify($emailVerifyToken));
        return ['message' => 'Success'];
    }

    public function verifyEmail(Request $request)
    {
        $currentUser = User::find($request->user()->id);
        if ($currentUser) {
            $emailVerifyToken = EmailVerifyToken::where('email', $currentUser->email)->first();
            if ($emailVerifyToken && $emailVerifyToken->expires_at > Carbon::now() && $emailVerifyToken->token === $request->input('token')) {
                $currentUser->update([
                    'email_verified_at' => Carbon::now()
                ]);
                $emailVerifyToken->delete();
                return ['message' => 'Success'];
            }
        }
        return ['message' => $request->input('token')];
    }

    public function getAuthenticatedUser(Request $request)
    {
        return User::where('id', $request->user()->id)->first();
    }
    
    public function registerCompany(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('company_name');
            $user->password = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->address = $request->input('company_address');
            $user->role = Role::Company;
            $user->phone_number = $request->input('phone_number');
            $user->status= Status::PENDING;
            $user->save();

            $company = new ProfileCompany();
            $company->user_id = $user->id;
            $company->description= ' ';
            $company->phone	 = $request->input('phone_number');
            $company->general_information = ' ';
            $company->address = $request->input('company_address');
            $company->codeCompany = $request->input('company_code');
            $company->email = $request->input('email');
            $company->skill =' ';
            $company->save();
            return ['message' => 'Company register successfully!','status'=> '200'];
        }
        catch(\Exception $exception){
            throw new BadRequestHttpException($exception->getMessage());
        }
    }
}
