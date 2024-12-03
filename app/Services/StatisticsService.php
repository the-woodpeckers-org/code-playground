<?php

namespace App\Services;

use App\Http\Requests\SaveCVFormRequest;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Responses\APIResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\HiddenCompany;
use App\Models\ProfileCompany;
use App\Models\ProfileViewHistory;
use App\Utils\Constants\Role;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function statistics(Request $request)
    {
        $revenueData = DB::table('orders')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total)/1000000 as revenue')
        )
        ->groupBy('month')
        ->get();
        
        $userData = DB::table('users')
        ->where('role', 'user')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as users')
        )
        ->groupBy('month')
        ->get();

        $totalRevenue = DB::table('orders')->sum('total') / 1000000;
        $totalUsers = DB::table('users')->where('role',Role::User)->count();
        $totalContributors = DB::table('users')->where('role',Role::Contributor)->count();
        $totalCompanies = DB::table('users')->where('role',Role::Company)->count();
        $growthRate = $this->calculateGrowthRate();

        return response()->json([
            'revenue_data' => $revenueData,
            'user_data' => $userData,
            'total_revenue' => $totalRevenue,
            'total_users' => $totalUsers,
            'total_contributors' => $totalContributors,
            'total_companies' => $totalCompanies,
            'growth_rate' => $growthRate
        ]);
    }

    private function calculateGrowthRate()
    {
        $currentMonthUsers = DB::table('users')
            ->whereMonth('created_at', now()->month)
            ->count();
        
        $previousMonthUsers = DB::table('users')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        return $previousMonthUsers > 0 
            ? round(($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers * 100, 2)
            : 0;
    }
}
