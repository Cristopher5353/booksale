<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StoreRepository;
use App\Models\Store;

class StoreService {
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository) {
        $this->storeRepository = $storeRepository;
    }

    public function getStores() : Collection {
        return $this->storeRepository->getStores();
    }

    public function saveStore(Request $request) : void {
        $validated = $request->validate([
            'direction' => "required|max:255",
            'district' => "required|numeric",
            'lat' => "required",
            'long' => "required",
            'photo' => "required|image|mimes:jpeg,png,jpg"
        ]);

        if($request->hasfile("photo")) {
            $image = $request->file("photo");
            $nameImage = "store_".time().$image->getClientOriginalName();
            $newRoute = public_path("images/stores/".$nameImage);
            copy($image->getRealPath(), $newRoute);

            $store = new Store();
            $store->direction = $request->input("direction");
            $store->district_id = $request->input("district");
            $store->lat = $request->input("lat");
            $store->long = $request->input("long");
            $store->image = $nameImage;
            $store->user_id = Auth::user()->id;

            $this->storeRepository->saveStore($store);
        }
    }

    public function updateStore(Request $request, int $id) : void {
        if($request->hasfile("photo")) {
            $validated = $request->validate([
                'direction' => "required|max:255",
                'district' => "required|numeric",
                'lat' => "required",
                'long' => "required",
                'photo' => "required|image|mimes:jpeg,png,jpg"
            ]);

            $image = $request->file("photo");
            $nameImage = "store_".time().$image->getClientOriginalName();
            $newRoute = public_path("images/stores/".$nameImage);
            copy($image->getRealPath(), $newRoute);

            $store = $this->storeRepository->getStoreById($id);

            $urlPhotoStore = $store->image;
            $imagePath = public_path("images/stores/".$urlPhotoStore);
            unlink($imagePath);

            $store->direction = $request->input("direction");
            $store->district_id = $request->input("district");
            $store->lat = $request->input("lat");
            $store->long = $request->input("long");
            $store->image = $nameImage;

            $this->storeRepository->updateStore($store);
            
        } else {
            $validated = $request->validate([
                'direction' => "required|max:255",
                'district' => "required|numeric",
                'lat' => "required",
                'long' => "required"
            ]);

            $store = $this->storeRepository->getStoreById($id);

            $store->direction = $request->input("direction");
            $store->district_id = $request->input("district");
            $store->lat = $request->input("lat");
            $store->long = $request->input("long");

            $this->storeRepository->updateStore($store);
        }
    }

    public function deleteStore(int $id) : void {
        $store = $this->storeRepository->getStoreById($id);
        $urlPhotoStore = $store->image;
        $imagePath = public_path("images/stores/".$urlPhotoStore);
        unlink($imagePath);

        $this->storeRepository->deleteStore($store);
    }
}