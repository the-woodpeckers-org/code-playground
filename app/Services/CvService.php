<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use App\Models\Cv;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\TryCatch;

class CvService
{

    public function newCV(Request $request)
    {
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
        $cvs = Cv::where('user_id', $userId)
         ->with('application') 
         ->get();
         $applications = $cvs->pluck('application') 
                        ->flatten();
         $job_recruitments = $applications->pluck('job')->flatten();

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $cvs,
            'applications' => $applications,
          //  'job_recruitments' => $job_recruitments
        ]);
    }

    public function getCV($id)
    {
      
        $cv = Cv::find($id); 
        if (!$cv) {
            return response()->json(['error' => 'CV not found'], 404);
        }
        return response()->json($cv);
    }

    public function deleteCV($id)
    {
        $cv = Cv::find($id);
        if($cv->application()->count() > 0) {
            return response()->json([
                'status' => 400,
                'message' => 'Cannot delete CV because it is being used in applications',
            ]);
        }
        $cv->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
        ]);
    }

    public function setPrimaryCv(Request $request)
    {
        $userId = $request->user()->id;
        $cvs = Cv::where('user_id', $userId)->get();
        foreach ($cvs as $cv) {
            if ($cv->id == $request->input('cv_id')) {
                $cv->isPrimary = 1;
            } else {
                $cv->isPrimary = 0;
            }
            $cv->save();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $cvs
        ]);
    }
   
}
