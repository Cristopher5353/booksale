<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Store;

class StoreRepository {
    public function getStores() : Collection {
        return Store::all();
    }  

    public function saveStore(Store $store) : void {
        $store->save();
    }

    public function getStoreById(int $id) : Store { 
        return Store::find($id);
    }

    public function updateStore(Store $store) : void {
        $store->update();
    }

    public function deleteStore(Store $store) : void {
        $store->delete();
    }
}