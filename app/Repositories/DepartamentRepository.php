<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Departament;

class DepartamentRepository {
    public function getAll() : Collection {
        return Departament::all();
    }

    public function getById(int $id) : Departament {
        return Departament::find($id);
    }

    public function getProvinces(Departament $departament) : Collection {
        return $departament->provinces;
    }
}