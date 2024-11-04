<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProfileUser;
class ProfileUserController
{
    //
    
        private ProfileUser $service;
        public function __construct(ProfileUser $_service)
        {
            $this->service = $_service;
        }
}
