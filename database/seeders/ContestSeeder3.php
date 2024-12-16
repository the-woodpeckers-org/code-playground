<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Problem;
use App\Models\ProblemLanguage;
use App\Models\Testcase;
use App\Utils\Constants\Status;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestSeeder3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contests = [
            [
                'title' => 'Amazon Weekly Contest',
                'description' => 'Amazon Weekly Contest',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSLFByHyQugaRKTQgDwOHePsB8TpRMazAj0A&s',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 8,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'HUIT Weekly Contest #1',
                'description' => 'HUIT Weekly Contest #1',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTq1XHxZ7J9ihIsXlWmmkilsVmCQF05x_Q-Rg&s',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 2,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Apple Hackathon',
                'description' => 'Apple Hackathon',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQy8ivjh3jEgWs6uv7DMzADcxPcFaWP00H1hQ&s',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 9,
                'status' => Status::APPROVED
            ]
        ];

        foreach ($contests as $contest) {
            Contest::create($contest);
        }


        $problems = [
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 4,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 4,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 5,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 5,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 6,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 6,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
        ];

        foreach ($problems as $problem) {
            Problem::create($problem);
        }

        $testcases = [
            [
                'problem_id' => 24,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 24,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 26,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 27,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 27,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 22,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 23,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 23,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 25,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
            [
                'problem_id' => 24,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 26,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 24,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 27,
                'stdin' => '4 5 1',
                'expected_output' => '10'
            ],
            [
                'problem_id' => 27,
                'stdin' => '10 5 5',
                'expected_output' => '20'
            ],
            [
                'problem_id' => 22,
                'stdin' => '7 1 7',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 9,
                'stdin' => '0 0 0 1',
                'expected_output' => '1'
            ],
            [
                'problem_id' => 23,
                'stdin' => '100 10 1 1',
                'expected_output' => '112'
            ],
            [
                'problem_id' => 25,
                'stdin' => '25 25 25 25',
                'expected_output' => '100'
            ],
        ];

        foreach ($testcases as $testcase) {
            Testcase::create($testcase);
        }

        $problem_languages = [
            [
                'problem_id' => '22',
                'language_id' => '2',
            ],
            [
                'problem_id' => '23',
                'language_id' => '2',
            ],
            [
                'problem_id' => '24',
                'language_id' => '2',
            ],
            [
                'problem_id' => '25',
                'language_id' => '2',
            ],
            [
                'problem_id' => '26',
                'language_id' => '2',
            ],
            [
                'problem_id' => '27',
                'language_id' => '2',
            ]
        ];

        foreach ($problem_languages as $language) {
            ProblemLanguage::create($language);
        }
    }
}
