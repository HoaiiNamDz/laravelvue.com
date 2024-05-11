<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $provinceRepository;
    protected $districtRepository;

    public function __construct(
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository
    ) {
        $this->provinceRepository = $provinceRepository; 
        $this->districtRepository = $districtRepository; 
    }

    public function provinces()
    {   
        $provinces = $this->provinceRepository->all();
        return response()->json([
            'message' => 'Truy xuất dữ liệu thành công',
            'data' => $provinces
        ], 200);
    }

    public function locations(Request $request)
    {   
        $location = [];
        $repo = ($request->input('relation') == 'districts') ? 'provinceRepository' : 'districtRepository';
        $model = $this->$repo->findById($request->input('id'), ['code', 'name'], [$request->input('relation')]);
        return $model;
    }
}
