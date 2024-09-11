<?php

namespace Database\Seeders;

use App\Models\Problem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problems = [
            [
                'title' => 'Sum of three numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of four numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of five numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of six numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 99.6
            ],
            [
                'title' => 'Sum of seven numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 43.1
            ],[
                'title' => 'Sum of eight numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of nine numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of ten numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of eleven numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of twelve numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of thirteen numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of fourteen numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of fifteen numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 32.1
            ],
            [
                'title' => 'Sum of sixteen numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 32.1
            ],
        ];
        foreach ($problems as $problem) {
            Problem::create($problem);
        }
    }
}
