<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController
{
    //
    public function upload(Request $request)
    {
        try {
            if (!$request->hash_file('file')) {
                return 'co file roi';
            }
            $response = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();         
            return $response;
        } catch (\Exception $e) {
            return $e . "loi";
        }
    }
}
