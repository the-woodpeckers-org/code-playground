<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use App\Models\Cv;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class CvService
{

    public function newCV()
    {
        // xử lý logic và các phần khác sẽ tiến hành sau khi có các dữ liệu data user, cv
        return response()->json([
            'message' => 'hehehe?',
            'id' => 1
        ]);
    }

    public function saveCV(Request $request)
    {
        $userId = 1;
        $content = $request->input('content');
        try {
            $cv = new Cv();
            $cv->user_id = $userId;
            $cv->content = $content;
            $cv->title ='test';
            $cv->save();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $content
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 200,
                'message' => $th,
                'data' => $content
            ]);
        }
    }
}
