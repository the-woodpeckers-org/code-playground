<?php

namespace App\Services;

use App\Models\Cv;
use Illuminate\Http\Request;
use App\Responses\APIResponse;

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
        if (auth('sanctum')->check()) {
            $userId = auth('sanctum')->user()->id;
           
            $exist = Cv::where('id', $request->id)->first();
            if($exist)
            {
                
            }
            else{
                $cv = new Cv();
             //   $cv->user_id = 
            }
        }
    }
}
