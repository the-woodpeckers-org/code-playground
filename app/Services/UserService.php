<?php

namespace App\Services;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class UserService
{
    public function uploadAvatar(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'No file uploaded'], 400);
            }
            $file = $request->file('file');
            $response = cloudinary()->upload($file->getRealPath())->getSecurePath();
            User::where('id', $request->user()->id)->first()->update(['avatar_url' => $response]);
            return ['message' => 'Success', 'url' => $response];
        } catch (\Exception $e) {
            return throw new ServiceUnavailableHttpException($e->getMessage());
        }
    }

    public function updateUser(UpdateUserFormRequest $request)
    {
        try {
            $user = User::find($request->user()->id);
            $user->update($request->validated());
            return ['message' => 'Success'];
        }
        catch (\Exception $e) {
            throw new ServiceUnavailableHttpException($e->getMessage());
        }
    }

    public function getStats(Request $request): array
    {
        return $request->user()->getStatsAttribute();
    }

    public function getStatsById(Request $request): array
    {
        return User::find($request->input('id'))->getStatsAttribute();
    }
}
