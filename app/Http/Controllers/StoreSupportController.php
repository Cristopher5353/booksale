<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StoreService;
use App\Services\UbigeoService;
use App\Models\Store;

class StoreSupportController extends Controller
{
    protected $storeService;
    protected $ubigeoService;

    public function __construct(StoreService $storeService, UbigeoService $ubigeoService) {
        $this->storeService = $storeService;
        $this->ubigeoService = $ubigeoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->storeService->getStores();
        return view("storesSupport.index", compact("stores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = $this->ubigeoService->getAllDepartaments();
        return view("storesSupport.create", compact("departaments"));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
       $this->storeService->saveStore($request);
        return redirect()->route("mantenimiento-tiendas.index")->with(["message" => "Tienda agregada correctamente"]);
    }

    // /**s
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit(int $id)
    {
        $response = $this->ubigeoService->getUbigeoByStore($id);
        return view("storesSupport.edit", $response);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, int $id)
    {
       $this->storeService->updateStore($request, $id);
        return redirect()->route("mantenimiento-tiendas.index")->with(["message" => "Tienda actualizada correctamente"]);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(int $id)
    {
        $this->storeService->deleteStore($id);
        return redirect()->route("mantenimiento-tiendas.index")->with(["message" => "Tienda eliminada correctamente"]);
    }
}
