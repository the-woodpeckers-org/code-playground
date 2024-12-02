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
use App\Models\SubscriptionAttribute;
use App\Utils\Constants\Role;
use App\Models\Order;   
use App\Utils\Constants\Subscription;
use Carbon\Carbon;
use App\Utils\Constants\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'codeplayground@gmail.com',
            'password' => Hash::make('123'),
            'role' => Role::Admin
        ];
        User::create($admin);
        $user = [
            'name' => 'Vũ Thanh Dương',
            'email' => 'duongdeptrai102x@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Ho Chi Minh City',
            'phone_number' => '0360100250',
            'gender' => 'None',
            'birthday' => '2003-01-11',
            'avatar_url' => 'https://res.cloudinary.com/dazvvxymm/image/upload/v1726166331/dumemay_o6j36t.jpg',
            'role' => Role::Contributor
        ];
        User::create($user);
        $user = [
            'name' => 'Bảo Vinh Phan',
            'email' => 'pv198357@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Ho Chi Minh City',
            'phone_number' => '0344052691',
            'gender' => 'Male',
            'birthday' => '2003-01-01',
            'avatar_url' => 'https://res.cloudinary.com/dazvvxymm/image/upload/v1726165796/image_1_e6zwtv.png',
            'role' => Role::User
        ];
        User::create($user);
        $user = [
            'name' => 'Kim Phượng Phạm',
            'email' => 'karinapham03@gmail.com',
            'password' => Hash::make('123'),
            'address' => 'Ho Chi Minh City',
            'phone_number' => '0388146321',
            'gender' => 'Female',
            'birthday' => '2003-01-01',
            'avatar_url' => 'https://res.cloudinary.com/dazvvxymm/image/upload/v1726165795/IMG_20240912_215515_qsgvrn.jpg',
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
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of three numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
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
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 1,
                'status' => Status::ACTIVE
            ],
            [
                'title' => 'ZoBoi Hackathon Aishh',
                'description' => 'Hehe boi',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThHzVwYwhZph2gph0cCeoP-d6nj3aB-ZogMA&s',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 1,
                'status' => Status::ACTIVE
            ],
            [
                'title' => 'CMS Hackathon numberthon',
                'description' => 'Hehe boi',
                'imgUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI6FdZ-KcBkNiy0cBtPZaYWKtmTajsmOtehQ&s',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'created_by' => 1,
                'status' => Status::ACTIVE
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
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 1,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 2,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of two numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of three numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Medium',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => 'approved'
            ],
            [
                'title' => 'Sum of four numbers',
                'contest_id' => 3,
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Hard',
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

        // create company
        $company1 = new User();
        $company1->name = 'Google';
        $company1->email = 'google@gmail.com';
        $company1->password = Hash::make('123');
        $company1->role = Role::Company;
        $company1->avatar_url = 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg';
        $company1->status = Status::APPROVED;
        $company1->save();

        $order_company1 = new Order();
        $order_company1->user_id = $company1->id;
        $order_company1->total = Subscription::PRICE;
        $order_company1->save();

        SubscriptionAttribute::create([
            'order_id' => $order_company1->id,
            'subscription_name' => Subscription::PREMIUM,
            'start_date' => Carbon::now(),
            'end_date'=> Carbon::now()->addDays(30)
        ]);
        
        $profile_company1 = new ProfileCompany();
        $profile_company1->user_id = $company1->id;
        $profile_company1->description = 'Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, a search engine, cloud computing, software, and hardware.';
        $profile_company1->general_information = 'Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, a search engine, cloud computing, software, and hardware.';
        $profile_company1->email = 'google@gmail.com';
        $profile_company1->phone = '0123456789';
        $profile_company1->address = 'Mountain View, California, United States';
        $profile_company1->skill = '["Java", "Python", "C++"]';
        $profile_company1->codeCompany = '123';
        $profile_company1->save();

        

        $company2 = new User();
        $company2->name = 'Facebook';
        $company2->email = 'facebook@gmail.com';
        $company2->password = Hash::make('123');
        $company2->role = Role::Company;
        $company2->status = Status::APPROVED;
        $company2->avatar_url = 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg';
        $company2->save();

        $order_company2 = new Order();
        $order_company2->user_id = $company2->id;
        $order_company2->total = Subscription::PRICE;
        $order_company2->save();
        
        SubscriptionAttribute::create([
            'order_id' => $order_company2->id,
            'subscription_name' => Subscription::PREMIUM
        ]);



        $profile_company2 = new ProfileCompany();
        $profile_company2->user_id = $company2->id;
        $profile_company2->description = 'Facebook is an American online social media and social networking service company based in Menlo Park, California.';
        $profile_company2->general_information = 'Facebook is an American online social media and social networking service company based in Menlo Park, California.';
        $profile_company2->email = 'facebook@gmail.com';
        $profile_company2->phone = '0123456789';
        $profile_company2->address = 'Menlo Park, California, United States';
        $profile_company2->skill = '["Java", "Python", "C++"]';
        $profile_company2->codeCompany = '123';
        $profile_company2->save();

        $company3 = new User();
        $company3->name = 'Amazon';
        $company3->email = 'amazon@gmail.com';
        $company3->password = Hash::make('123');
        $company3->role = Role::Company;
        $company3->status = Status::APPROVED;
        $company3->avatar_url = 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg';
        $company3->save();

        $order_company3 = new Order();
        $order_company3->user_id = $company3->id;
        $order_company3->total = Subscription::PRICE;
        $order_company3->save();


        SubscriptionAttribute::create([
            'order_id' => $order_company3->id,
            'subscription_name' => Subscription::PREMIUM
        ]);

        $profile_company3 = new ProfileCompany();
        $profile_company3->user_id = $company3->id;
        $profile_company3->description = 'Amazon.com, Inc. is an American multinational technology company which focuses on e-commerce, cloud computing, digital streaming, and artificial intelligence.';
        $profile_company3->general_information = 'Amazon.com, Inc. is an American multinational technology company which focuses on e-commerce, cloud computing, digital streaming, and artificial intelligence.';
        $profile_company3->email = 'amazon@gmail.com';
        $profile_company3->phone = '0123456789';
        $profile_company3->address = 'Seattle, Washington, United States';
        $profile_company3->skill = '["Java", "Python", "C++"]';
        $profile_company3->codeCompany = '123';
        $profile_company3->save();

        $company4 = new User();
        $company4->name = 'Apple';
        $company4->email = 'apple@gmail.com';
        $company4->password = Hash::make('123');
        $company4->role = Role::Company;
        $company4->avatar_url = 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg';
        $company4->status = Status::APPROVED;
        $company4->save();

        $order_company4 = new Order();
        $order_company4->user_id = $company4->id;
        $order_company4->total = Subscription::PRICE;
        $order_company4->save();


        SubscriptionAttribute::create([
            'order_id' => $order_company4->id,
            'subscription_name' => Subscription::PREMIUM
        ]);

        $profile_company4 = new ProfileCompany();
        $profile_company4->user_id = $company4->id;
        $profile_company4->description = 'Apple Inc. is an American multinational technology company that specializes in consumer electronics, computer software, and online services.';
        $profile_company4->general_information = 'Apple Inc. is an American multinational technology company that specializes in consumer electronics, computer software, and online services.';
        $profile_company4->email = 'apple@gmail.com';
        $profile_company4->phone = '0123456789';
        $profile_company4->address = 'Cupertino, California, United States';
        $profile_company4->skill = '["Java", "Python", "C++"]';
        $profile_company4->codeCompany = '123';
        $profile_company4->save();

        $company5 = new User();
        $company5->name = 'Microsoft';
        $company5->email = 'microsoft@gmail.com';
        $company5->password = Hash::make('123');
        $company5->role = Role::Company;
        $company5->avatar_url = 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1731599349/toqqujiuzub394udt0c3.jpg';
        $company5->status = Status::APPROVED;
        $company5->save();

        $order_company5 = new Order();
        $order_company5->user_id = $company5->id;
        $order_company5->total = Subscription::PRICE;
        $order_company5->save();


        SubscriptionAttribute::create([
            'order_id' => $order_company5->id,
            'subscription_name' => Subscription::PREMIUM
        ]);

        $profile_company5 = new ProfileCompany();
        $profile_company5->user_id = $company5->id;
        $profile_company5->description = 'Microsoft Corporation is an American multinational technology company which produces computer software, consumer electronics, personal computers, and related services.';
        $profile_company5->general_information = 'Microsoft Corporation is an American multinational technology company which produces computer software, consumer electronics, personal computers, and related services.';
        $profile_company5->email = 'microsoft@gmail.com';
        $profile_company5->phone = '0123456789';
        $profile_company5->address = 'Redmond, Washington, United States';
        $profile_company5->skill = '["Java", "Python", "C++"]';
        $profile_company5->codeCompany = '123';
        $profile_company5->save();

        $problems2 = [
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ],
            [
                'title' => 'Sum of two numbers',
                'description' => 'Use your super brain to solve this!!!',
                'difficulty' => 'Easy',
                'acceptance_rate' => 0,
                'created_by' => 1,
                'status' => Status::APPROVED
            ]
        ];
        foreach ($problems2 as $problem) {
            Problem::create($problem);
        }

        $testcases2 = [
            [
                'problem_id' => 13,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 14,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 15,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 16,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 17,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 18,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
            [
                'problem_id' => 19,
                'stdin' => '4 5',
                'expected_output' => '9'
            ],
            [
                'problem_id' => 20,
                'stdin' => '10 5',
                'expected_output' => '15'
            ],
            [
                'problem_id' => 21,
                'stdin' => '7 1',
                'expected_output' => '8'
            ],
        ];

        foreach ($testcases2 as $testcase) {
            Testcase::create($testcase);
        }

        for($i = 13; $i <= 21; $i++) {
            $problem_languages2 = [
                [
                    'problem_id' => $i,
                    'language_id' => '1',
                ],
                [
                    'problem_id' => $i,
                    'language_id' => '2',
                ],
            ];
            foreach ($problem_languages2 as $p_language) {
                ProblemLanguage::create($p_language);
            }
            $problem_tags2 = [
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Math')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Bit Manipulation')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Sliding Window')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Dynamic Programming')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Sorting')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Greedy')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Hash Table')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'String')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Array')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Counting')->first()->id,
                ],
                [
                    'problem_id' => $i,
                    'category_id' => Category::where('name', 'Two Pointers')->first()->id,
                ],
            ];
            foreach ($problem_tags2 as $tag) {
                ProblemTag::create($tag);
            }
        }
    }
}
