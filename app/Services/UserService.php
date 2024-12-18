<?php

namespace App\Services;

use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use App\Utils\Constants\Role;
use Carbon\Carbon;
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

    public function requestToBecomeContributor(Request $request)
    {
        $user = User::find($request->user()->id);
        $user->update([
            'requested_to_contributor' => 'pending'
        ]);
        return ['message' => 'Success'];
    }

    public function updateUser(UpdateUserFormRequest $request)
    {
        try {
            $user = User::find($request->user()->id);
            $user->update($request->validated());
            return ['message' => 'Success'];
        } catch (\Exception $e) {
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

    public function getLandingRanking()
    {
        return User::withCount(['attempts' => function ($query) {
            $query->where('attempts.created_at', '>', Carbon::now()->addDays(-7));
        }])
            ->where('role', '!=', Role::Company)->where('role', '!=', Role::Admin)
            ->orderBy('attempts_count', 'desc')
            ->take(10)
            ->get();
    }

    public function getUserGuard(Request $request)
    {
        return User::select(['name', 'avatar_url', 'role', 'created_at'])
            ->where('id', $request->input('id'))
            ->first();
    }
}
