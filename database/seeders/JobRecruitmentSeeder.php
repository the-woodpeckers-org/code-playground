<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobRecruitment;
use App\Models\Application;
use App\Models\ProfileCompany;
use Carbon\Carbon;
class JobRecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // 'user_id',        
        // 'title',      
        // 'description',
        // 'location',      
        // 'salary',  
        // 'deadline',
        
        

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
        $profile->general_information="We are a software company";
        $profile->email="tuyendung@gmail.com";
        $profile->phone="0123456789";
        $profile->address="Ho Chi Minh City";
        $profile->skill="PHP, Laravel, ReactJS";
        $profile->save();

    }
}
