<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobRecruitment;
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
        $job_rece->user_id = 1;
        $job_rece->title = 'Software Engineer';
        $job_rece->description = 'We are looking for a software engineer to join our team';
        $job_rece->location = 'Ho Chi Minh City';
        $job_rece->salary = 1000;
        $job_rece->deadline = Carbon::createFromFormat('Y-m-d', '2024-11-30'); // Sử dụng Carbon để tạo đối tượng ngày
        $job_rece->save();
    }
}
