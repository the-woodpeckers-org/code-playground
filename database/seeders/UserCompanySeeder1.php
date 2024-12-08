<?php

namespace Database\Seeders;

use App\Models\JobRecruitment;
use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Utils\Constants\Status;
class UserCompanySeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ABBANKCompany = new User();
        $ABBANKCompany->name = 'Ngân hàng TMCP An Bình (ABBANK)';


    }
}
