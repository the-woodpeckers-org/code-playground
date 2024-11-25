<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Cv;
use App\Models\JobRecruitment;
use App\Models\Language;
use App\Models\Problem;
use App\Models\ProblemLanguage;
use App\Models\ProblemTag;
use App\Models\ProfileCompany;
use App\Models\ProfileUser;
use App\Models\Testcase;
use App\Models\User;
use App\Utils\Constants\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Vũ Thanh Dương',
            'email' => 'duongdeptrai102x@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Ho Chi Minh City',
            'phone_number' => '0360100250',
            'gender' => 'None',
            'birthday' => '2003-01-11',
            'avatar_url' => 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg',
            'role' => Role::Contributor
        ];

        User::create($user);

        $user = [
            'name' => 'Bảo Vinh Phan',
            'email' => 'barovinh@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Ho Chi Minh City',
            'phone_number' => '0360100250',
            'gender' => 'None',
            'birthday' => '2003-01-01',
            'avatar_url' => 'https://res-console.cloudinary.com/dazvvxymm/thumbnails/v1/image/upload/v1726165796/aW1hZ2VfMV9lNnp3dHY=/drilldown',
            'role' => Role::User
        ];
        User::create($user);

        $user = [
            'name' => 'Riot Games Inc',
            'email' => 'tuyendung@gmail.com',
            'password' => Hash::make('123'),
            'address' => null,
            'role' => Role::Company,
            'phone_number' => '0123456789',
            'status' => 'approved',
            'gender' => 'None',
            'birthday' => '2003-01-01',
            'avatar_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAGvRhdg1vaZyhkn5zzE7p35e70SUgv0TVCw&s'
        ];

        User::create($user);
        $problems = [
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of three numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of four numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
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

        $contests = [
            [
                'title' => 'Viettel Hackathon 2024',
                'description' => 'Hehe boi',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRW7S24aqeMJVm-ofv0JGjUFakDXJeV6WpJfQ&s',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 10, 18, 18, 15, 00),
                'created_by' => 1
            ],
            [
                'title' => 'ZoBoi Hackathon Aishh',
                'description' => 'Hehe boi',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThHzVwYwhZph2gph0cCeoP-d6nj3aB-ZogMA&s',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 10, 10, 22, 10, 00),
                'created_by' => 1
            ],
            [
                'title' => 'CMS Hackathon numberthon',
                'description' => 'Hehe boi',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI6FdZ-KcBkNiy0cBtPZaYWKtmTajsmOtehQ&s',
                'start_date' => Carbon::create(2024, 9, 27, 12, 30, 00),
                'end_date' => Carbon::create(2024, 10, 15, 12, 30, 00),
                'created_by' => 1
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
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'active'
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
                'problem_id' => 7,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 7,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 7,
                'stdin' => '7 1',
                'expected_output' => '8'
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

        $cv = new Cv();
        $cv->user_id = 1;
        $cv->content = '[{"type":"info","name":"John Doe","table1":{"class":"info-table1","label":["Address:","Phone:","Email:"],"content":["123 State St.<br>Oslo, Norway","555-123-4567","john@polygonal.eu"]},"table2":{"class":"info-table2","label":["Website:","Linkedin","Twitter:"],"content":["https://polygonal.eu","https://www.linkedin.com/","@johndoe"]}},{"type":"single-block","title":"About Me","list":["I am a brewer with 12 years of experience, specialized in wild yeast fermentation and barrel-aging."]},{"type":"listing","title":"Professional Experience","list":[{"date":"2017-2020","location":"Polygonal Brewing Co.","position":"\n        \n        \n        \n        Head Brewer\n        \n        \n        \n        ","description":"\n        \n        \n        \n        As head brewer, I partner with the marketing team to plan recipes and the production schedule. I manage a team of 4 people and ensure inventory is up to date.\n        \n        \n        \n        "},{"date":"2015-2017","location":"Polygonal Brewing Co.","position":"\n        \n        \n        \n        Assistant Brewer\n        \n        \n        \n        ","description":"\n        \n        \n        \n        As assistant brewer I was in charge of production, facility sanitation, product packaging, while ensuring proper brewing and hygiene routines.\n        \n        \n        \n        "},{"date":"2013-2015","location":"Polygonal Taproom","position":"\n        \n        \n        \n        Bartender\n        \n        \n        \n        ","description":"\n        \n        \n        \n        On top of customer relations, I maintained cleanliness of taps and beer lines to ensure optimal product quality. I also organized various events and special releases.\n        \n        \n        \n        "}]},{"type":"listing","title":"Education","list":[{"date":"2015","location":"Institute of Brewing","position":"\n        \n        \n        \n        Certificate in Brewing\n        \n        \n        \n        ","description":"\n        \n        \n        \n        This certificate covers all aspects of beer production from recipe inception, to process and packaging.\n        \n        \n        \n        "},{"date":"2012-2014","location":"University of Grenoble","position":"\n        \n        \n        \n        Bachelor in Communications\n        \n        \n        \n        ","description":"\n        \n        \n        \n        This degree trained me in public relations and online communications with a special focus on social media.\n        \n        \n        \n        "}]},{"type":"three-column","title":"Skills","list":["Brewing","Recipe Inception","Barrel Aging","Beersmith","Fluent in French and English","Office Suite","Various Social Media Platforms"]},{"type":"three-column","title":"Interests","list":["Reading","Music","Cooking","Writing","Rock Climbing"]}]';
        $cv->title = 'test';
        $cv->save();

        $pv = new ProfileUser();
        $pv->user_id = 1;
        $pv->job_position = 'Software developer';
        $pv->experience = 5;
        $pv->social = 'https://www.linkedin.com/,https://www.linkedin.com/';
        $pv->skill = '["C","Java","Python"]';
        $pv->save();


        $job_rece = new JobRecruitment();
        $job_rece->user_id = 3;
        $job_rece->title = 'Software Engineer';
        $job_rece->description = 'We are looking for a software engineer to join our team';
        $job_rece->location = 'Ho Chi Minh City';
        $job_rece->skill = '["PHP", "Laravel", "ReactJS"]';
        $job_rece->salary = 1000;
        $job_rece->deadline = Carbon::createFromFormat('Y-m-d', '2024-11-30'); // Sử dụng Carbon để tạo đối tượng ngày
        $job_rece->save();


        $application = new Application();
        $application->user_id = 1;
        $application->job_id = $job_rece->id;
        $application->cv_id = 1;
        $application->status = 'pending';
        $application->applied_at = Carbon::now();
        $application->save();


        // 'user_id',
        // 'description',
        // 'general_information',
        // 'address',
        // 'phone',
        // 'email',
        // 'skill',
        $profile = new ProfileCompany();
        $profile->user_id = 3;
        $profile->description = 'hehe';
        $profile->general_information = "We are a software company";
        $profile->email = "tuyendung@gmail.com";
        $profile->phone = "0123456789";
        $profile->address = "Ho Chi Minh City";
        $profile->skill = "PHP, Laravel, ReactJS";
        $profile->codeCompany = "123";
        $profile->save();

        $languages = [
            [
                'name' => 'C++'
            ],
            [
                'name' => 'C'
            ],
            [
                'name' => 'Python'
            ],
            [
                'name' => 'PHP'
            ],
            [
                'name' => 'JavaScript'
            ]
        ];
        foreach ($languages as $language) {
            Language::create($language);
        }
        $problem_languages = [
            [
                'problem_id' => '1',
                'language_id' => '1',
            ],
            [
                'problem_id' => '1',
                'language_id' => '2',
            ],
            [
                'problem_id' => '1',
                'language_id' => '3',
            ],
            [
                'problem_id' => '2',
                'language_id' => '1',
            ],
            [
                'problem_id' => '2',
                'language_id' => '2',
            ],
            [
                'problem_id' => '3',
                'language_id' => '1',
            ],
            [
                'problem_id' => '3',
                'language_id' => '2',
            ],
            [
                'problem_id' => '4',
                'language_id' => '1',
            ],
            [
                'problem_id' => '4',
                'language_id' => '2',
            ],
            [
                'problem_id' => '5',
                'language_id' => '1',
            ],
            [
                'problem_id' => '5',
                'language_id' => '2',
            ],
            [
                'problem_id' => '6',
                'language_id' => '1',
            ],
            [
                'problem_id' => '6',
                'language_id' => '2',
            ],
            [
                'problem_id' => '7',
                'language_id' => '1',
            ],
            [
                'problem_id' => '7',
                'language_id' => '2',
            ],
            [
                'problem_id' => '8',
                'language_id' => '1',
            ],
            [
                'problem_id' => '8',
                'language_id' => '2',
            ],
            [
                'problem_id' => '9',
                'language_id' => '1',
            ],
            [
                'problem_id' => '9',
                'language_id' => '2',
            ],
            [
                'problem_id' => '10',
                'language_id' => '1',
            ],
            [
                'problem_id' => '10',
                'language_id' => '2',
            ],
            [
                'problem_id' => '11',
                'language_id' => '1',
            ],
            [
                'problem_id' => '11',
                'language_id' => '2',
            ],
            [
                'problem_id' => '12',
                'language_id' => '1',
            ],
            [
                'problem_id' => '12',
                'language_id' => '2',
            ],
        ];

        foreach ($problem_languages as $p_language) {
            ProblemLanguage::create($p_language);
        }

        // Category
        $categories = [
            [
                'name' => 'Math'
            ],
            [
                'name' => 'Bit Manipulation'
            ],
            [
                'name' => 'Sliding Window'
            ],
            [
                'name' => 'Dynamic Programming'
            ],
            [
                'name' => 'Sorting'
            ],
            [
                'name' => 'Greedy'
            ],
            [
                'name' => 'Hash Table'
            ],
            [
                'name' => 'String'
            ],
            [
                'name' => 'Array'
            ],
            [
                'name' => 'Counting'
            ],
            [
                'name' => 'Two Pointers'
            ],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
        // end Category

        // Problem Tags
        $problem_tags = [
            [
                'problem_id' => '1',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '1',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '2',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '2',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '3',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '3',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '4',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '4',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '5',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '5',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '6',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '6',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '7',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '7',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '8',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '8',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '9',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '9',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '10',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '10',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '11',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '11',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ],
            [
                'problem_id' => '12',
                'category_id' => Category::where('name', 'Math')->first()->id,
            ],
            [
                'problem_id' => '12',
                'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
            ]
        ];

        foreach ($problem_tags as $tag) {
            ProblemTag::create($tag);
        }
        // end Problem Tags
    }
}
