<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Province;

class ProvinceRepository {
    public function getById(int $id) : Province{
        return Province::find($id);
    }

    public function getDistricts(Province $province) : Collection {
        return $province->districts;
    }
}