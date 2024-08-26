<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('home.index');
    }

    public function compileCode(Request $request)
    {
        $language = $request['language'];
        if ($language == 'cpp') {
            $code = $request->code;
            $random = substr(md5(mt_rand()), 0, 7);
            $filePath = "program\\" . $random . ".cpp";
            $programFile = fopen($filePath, "w+");

            fwrite($programFile, $code);
            fclose($programFile);

            $outputExecute = 'program' . '\\' . $random . ".exe";
            $output = shell_exec("C:\TDM-GCC-64\bin\g++ $filePath -o $outputExecute 2>&1");
            if (!file_exists($outputExecute)) {
                return response()->json(['output' => $output]);
            }
            $output = shell_exec('echo ' . $request['input'] . ' | ' . $outputExecute . " 2>&1");
            return response()->json(['output' => $output]);
        }
        if ($language == 'c') {
            $code = $request->code;
            $random = substr(md5(mt_rand()), 0, 7);
            $filePath = "program\\" . $random . ".c";
            $programFile = fopen($filePath, "w+");

            fwrite($programFile, $code);
            fclose($programFile);

            $outputExecute = 'program' . '\\' . $random . ".exe";
            $output = shell_exec("C:\TDM-GCC-64\bin\gcc $filePath -o $outputExecute 2>&1");
            if (!file_exists($outputExecute)) {
                return response()->json(['output' => $output]);
            }
            $output = shell_exec('echo ' . $request['input'] . ' | ' . $outputExecute . " 2>&1");
            return response()->json(['output' => $output]);
        }

    }
}
