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
}
