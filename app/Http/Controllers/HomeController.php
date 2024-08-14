<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class HomeController extends Controller
{
    //
    public function index() {
        return view('home.index');
    }

    public function compileCode(Request $request) {
        $code = $request->code;
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".cpp";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);

        $outputExecute = 'program' . '\\' . $random . ".exe";
        shell_exec("C:\TDM-GCC-64\bin\g++ $filePath -o $outputExecute 2>&1");
        $output = shell_exec('echo 9 16 | ' . $outputExecute . " 2>&1");
        return response()->json(['output' => $output]);
    }
}
