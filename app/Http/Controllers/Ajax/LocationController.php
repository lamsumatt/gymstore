<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface;

class LocationController extends Controller
{
    protected $districtRepository;
    public function __construct(DistrictRepositoryInterface $districtRepository){
        $this->districtRepository = $districtRepository;
    }
    public function getLocation(Request $request)
    {
        $province_id = $request->input('province_id');
        echo $province_id; die();
    }
}
