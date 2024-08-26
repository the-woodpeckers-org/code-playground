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
        $code = $request->code;
        if ($language == 'cpp') {
            $random = substr(md5(mt_rand()), 0, 7);
            $filePath = "program\\" . $random . ".cpp";
            $programFile = fopen($filePath, "w+");

            fwrite($programFile, $code);
            fclose($programFile);

            $outputExecute = 'program' . '\\' . $random . ".exe";
            $output = shell_exec(base_path('public') . "\\execute_environment\TDM-GCC32\bin\g++ $filePath -o $outputExecute 2>&1");
            if (!file_exists($outputExecute)) {
                return response()->json(['output' => $output]);
            }
            $output = shell_exec('echo ' . $request['input'] . ' | ' . $outputExecute . " 2>&1");
            return response()->json(['output' => $output]);
        }
        else if ($language == 'c') {
            $random = substr(md5(mt_rand()), 0, 7);
            $filePath = "program\\" . $random . ".c";
            $programFile = fopen($filePath, "w+");

            fwrite($programFile, $code);
            fclose($programFile);

            $outputExecute = 'program' . '\\' . $random . ".exe";
            $output = shell_exec(base_path('public') . "\\execute_environment\TDM-GCC32\bin\gcc $filePath -o $outputExecute 2>&1");
            if (!file_exists($outputExecute)) {
                return response()->json(['output' => $output]);
            }
            $output = shell_exec('echo ' . $request['input'] . ' | ' . $outputExecute . " 2>&1");
            return response()->json(['output' => $output]);
        }
        else if ($language == 'python') {
            $random = substr(md5(mt_rand()), 0, 7);
            $filePath = "program\\" . $random . ".py";
            $programFile = fopen($filePath, "w+");

            fwrite($programFile, $code);
            fclose($programFile);
            $echoInputs = explode(' ', $request['input']);
            $echoCommand = '(';
            foreach ($echoInputs as $echoInput) {
                $echoCommand .= 'echo ' . $echoInput . '&';
            }
            $echoCommand = rtrim($echoCommand, '&');
            $echoCommand .= ')';
            $output = shell_exec($echoCommand . ' | ' . base_path('public') . "\\execute_environment\python-3.12.5-embed-amd64\python $filePath 2>&1");
//            $output = shell_exec('echo ' . $request['input'] . ' | ' . $outputExecute . " 2>&1");
            return response()->json(['output' => $output]);
        }

    }
}
