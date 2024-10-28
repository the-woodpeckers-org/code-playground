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

    public function newCV(Request $request)
    {
        // xử lý logic và các phần khác sẽ tiến hành sau khi có các dữ liệu data user, cv
        try {
            $userId = $request->user()->id;
            $cv = new Cv();
            $cv->user_id = $userId;
            $cv->title = $request->input('title');
            $cv->content = '';
            $cv->save();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'title' => $cv->title,
                'id' => $cv->id,

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'fail',
            ]);
        }
    }

    public function saveCV(Request $request)
    {
        $userId = $request->user()->id;
        $content = $request->input('content');
        try {

            $cv = CV::find($request->input('idCV'));
            $cv->user_id = $userId;
            $cv->content = $content;
            // $cv->title = 'test';
            $cv->save();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $content
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 501,
                'message' => $th,
                'data' => $content
            ]);
        }
    }
    public function getCvsU(Request $request)
    {
        $userId = $request->user()->id;
        $cvs = Cv::where('user_id', $userId)->get();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $cvs
        ]);
    }

    public function getCV($id)
    {
        // Tìm kiếm CV theo ID
        $cv = Cv::find($id); // hoặc Cv::where('id', $id)->first();

        // Kiểm tra nếu CV không tồn tại
        if (!$cv) {
            return response()->json(['error' => 'CV not found'], 404);
        }

        // Trả về dữ liệu CV
        return response()->json($cv);
    }

    public function deleteCV($id)
    {
        $cv = Cv::find($id);
        $cv->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
        ]);
    }
}
