<?php

namespace Database\Seeders;

use App\Models\Problem;
use App\Models\Testcase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Demo User',
            'email' => 'duongdeptrai102x@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Demo Address, City',
            'phone_number' => '0360100250',
            'gender' => 'None',
            'birthday' => '2003-01-01'
        ];

        User::create($user);

        $user = [
            'name' => 'Demo User',
            'email' => 'barovinh@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Demo Address, City',
            'phone_number' => '0360100250',
            'gender' => 'None',
            'birthday' => '2003-01-01'
        ];
        User::create($user);

        $user = [
            'name' => 'tao là nhà tuyển dụng',
            'email' => 'tuyendung@gmail.com',
            'password' => Hash::make('123'),
            'address' => null,
            'role'=> 1,
            'phone_number' => '0123456789',
            'gender' => 'None',
            'birthday' => '2003-01-01'
        ]; 

        User::create($user);
        $problems = [
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of three numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of four numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0
            ],
        ];

        foreach ($problems as $problem) {
            Problem::create($problem);
        }

        $testcases = [
            [
                'problem_id' => 1,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 1,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 1,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 2,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 2,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 2,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 3,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 3,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 3,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
        ];

        foreach ($testcases as $testcase) {
            Testcase::create($testcase);
        }
    }
}
