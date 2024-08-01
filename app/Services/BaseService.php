<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;


class BaseService implements BaseServiceInterface
{


    public function __construct()
    {

    }

    public function currentLanguage(){
        return 1;
    }

}