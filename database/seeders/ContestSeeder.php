<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Problem;
use App\Models\Testcase;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contests = [
            [
                'title' => 'Viettel Hackathon',
                'description' => 'Hehe boi',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 9, 30, 12, 30, 00),
            ],
            [
                'title' => 'ZoBoi Hackathon',
                'description' => 'Hehe boi',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 9, 30, 12, 30, 00),
            ],
            [
                'title' => 'CMS Hackathon',
                'description' => 'Hehe boi',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 9, 30, 12, 30, 00),
            ]
        ];

        foreach ($contests as $contest) {
            Contest::create($contest);
        }


        $problems = [
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 3,
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
                'problem_id' => 4,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 4,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 4,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 5,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 5,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 5,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 6,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 6,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 6,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
            [
                'problem_id' => 8,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 8,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 8,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 9,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 9,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 9,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
            [
                'problem_id' => 10,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 10,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 10,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 11,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 11,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 11,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 12,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 12,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 12,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
        ];

        foreach ($testcases as $testcase) {
            Testcase::create($testcase);
        }
    }
}
