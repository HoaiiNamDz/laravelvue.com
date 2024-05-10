<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $provinceRepository;

    public function __construct(
        ProvinceRepository $provinceRepository
    ) {
        $this->provinceRepository = $provinceRepository;
    }

    public function provinces()
    {   
        $provinces = $this->provinceRepository->all();
        return response()->json([
            'message' => 'Truy xuất dữ liệu thành công',
            'data' => $provinces
        ], 200);
    }

    
}
