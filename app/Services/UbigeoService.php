<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Repositories\DepartamentRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StoreRepository;

class UbigeoService {
    protected $departamentRepository;
    protected $provinceRepository;
    protected $storeRepository;

    public function __construct(DepartamentRepository $departamentRepository, ProvinceRepository $provinceRepository, StoreRepository $storeRepository) {
        $this->departamentRepository = $departamentRepository;
        $this->provinceRepository = $provinceRepository;
        $this->storeRepository = $storeRepository;
    }

    public function getAllDepartaments() : Collection {
        return $this->departamentRepository->getAll();
    }

    public function getUbigeoByStore(int $id) : array {
        $store = $this->storeRepository->getStoreById($id);
        $departaments = $this->departamentRepository->getAll();
        $provinces = $store->district->province->departament->provinces;
        $districts = $store->district->province->districts;

        return ["store" => $store, "departaments" => $departaments, "provinces" => $provinces, "districts" => $districts];
    }   

    public function getProvincesByDepartament(Request $request) : Collection {
        $departament = $this->departamentRepository->getById($request->id);
        return $this->departamentRepository->getProvinces($departament);
    }

    public function getDistrictsByProvince(Request $request) : Collection {
        $province = $this->provinceRepository->getById($request->id);
        return $this->provinceRepository->getDistricts($province);
    }
}