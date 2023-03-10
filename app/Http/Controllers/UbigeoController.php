<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UbigeoService;

class UbigeoController extends Controller
{
    protected $ubigeoService;

    public function __construct(UbigeoService $ubigeoService) {
        $this->ubigeoService = $ubigeoService;
    }

    public function getAllDepartaments() {
        return $this->ubigeoService->getAllDepartaments();
    }

    public function getProvincesByDepartament(Request $request) {
        if($request->ajax()) {
            return response()->json([
                "provinces" => $this->ubigeoService->getProvincesByDepartament($request)
            ]);
        }
    }

    public function getDistrictsByProvince(Request $request) {
        if($request->ajax()) {
            return response()->json([
                "districts" => $this->ubigeoService->getDistrictsByProvince($request)
            ]);
        }
    }
}
