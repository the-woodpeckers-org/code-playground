<?php

namespace App\Services;

use App\Models\Testcase;
use Illuminate\Http\JsonResponse;

class CodeExecutionService
{
    public function execute($language, $code, $input, $problem_id)
    {
        switch ($language) {
            case 'cpp':
                return $this->executeCpp($code, $input, $problem_id);
            case 'c':
                return $this->executeC($code, $input, $problem_id);
            case 'python':
                return $this->executePython($code, $input, $problem_id);
            case 'php':
                return $this->executePhp($code, $input, $problem_id);
            case 'javascript':
                return $this->executeJavascript($code, $input, $problem_id);
            default:
                break;
        }
        return response()->json(['output' => 'none']);
    }

    private function executeCpp($code, $input, $problem_id)
    {
        $results = array();
        $testcases = Testcase::where('problem_id', $problem_id)->get();
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".cpp";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);

        $outputExecute = 'program' . '\\' . $random . ".exe";

        $shell = shell_exec(base_path('public') . "\\execute_environment\TDM-GCC32\bin\g++ $filePath -o $outputExecute 2>&1");
        if (strlen($shell) > 0) {
            return response()->json(['succeed' => false, 'output' => $shell]);
        }
        foreach ($testcases as $testcase) {
            $results[] = shell_exec('echo ' . $testcase->stdin . ' | ' . $outputExecute . " 2>&1");
        }

        unlink($outputExecute);

        return response()->json(['output' => $results]);
    }

    private function executeC($code, $input, $problem_id)
    {
        $results = array();
        $testcases = Testcase::where('problem_id', $problem_id)->get();
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".c";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);

        $outputExecute = 'program' . '\\' . $random . ".exe";

        $shell = shell_exec(base_path('public') . "\\execute_environment\TDM-GCC32\bin\gcc $filePath -o $outputExecute 2>&1");

        if (strlen($shell) > 0) {
            return response()->json(['succeed' => false, 'output' => $shell]);
        }

        foreach ($testcases as $testcase) {
            $results[$testcase->id] = shell_exec('echo ' . $testcase->stdin . ' | ' . $outputExecute . " 2>&1");
        }

        unlink($outputExecute);

        return response()->json(['output' => json_encode($results)]);
    }

    private function executePython($code, $input, $problem_id)
    {
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".py";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);

        $echoInputs = explode(' ', $input);
        $echoCommand = '(';
        foreach ($echoInputs as $echoInput) {
            $echoCommand .= "echo '" . $echoInput . "'&";
        }
        $echoCommand = rtrim($echoCommand, '&');
        $echoCommand .= ')';
        $output = shell_exec($echoCommand . ' | ' . base_path('public') . "\\execute_environment\python-3.12.5-embed-amd64\python $filePath 2>&1");
        return response()->json(['output' => $output]);
    }

    private function executePhp($code, $input, $problem_id)
    {
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".php";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);
        $echoInputs = explode(' ', $input);
        $echoCommand = '%SYSTEMROOT%\System32\WindowsPowerShell\v1.0\powershell.exe "';
        foreach ($echoInputs as $echoInput) {
            $echoCommand .= "echo '" . $echoInput . "';";
        }
        $echoCommand = rtrim($echoCommand, ';');
        $output = shell_exec($echoCommand . ' | ' . base_path('public') . "\\execute_environment\php-8.3.10-nts-Win32-vs16-x64\php '$filePath' " . '" 2>&1');
        return response()->json(['output' => $output]);
    }

    private function executeJavascript($code, $input, $problem_id)
    {
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "program\\" . $random . ".js";
        $programFile = fopen($filePath, "w+");

        fwrite($programFile, $code);
        fclose($programFile);

        $output = shell_exec(base_path('public') . "\\execute_environment\\node-v20.17.0-win-x64\Node " . $filePath . " 2>&1");
        return response()->json(['output' => $output]);
    }
}
