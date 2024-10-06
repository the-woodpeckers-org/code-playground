<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController
{
    //
    public function upload(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'No file uploaded'], 400);
            }
            $file = $request->file('file');

            $response = cloudinary()->upload($file->getRealPath())->getSecurePath();

            return response()->json(['url' => $response], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
