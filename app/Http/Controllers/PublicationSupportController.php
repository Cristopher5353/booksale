<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\PublicationService;

class PublicationSupportController extends Controller
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService) {
        $this->publicationService = $publicationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = $this->publicationService->getPublications();
        return view("publicationsSupport.index", compact("publications"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view("publicationsSupport.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->publicationService->savePublication($request);
        return redirect()->route("mantenimiento-publicaciones.index")->with(["message" => "Publicación agregada correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $publication = $this->publicationService->getPublicationById($id);
        return view("publicationsSupport.edit", compact("publication"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->publicationService->updatePublication($request, $id);
        return redirect()->route("mantenimiento-publicaciones.index")->with(["message" => "Publicación actualizada correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->publicationService->deletePublication($id);
        return redirect()->route("mantenimiento-publicaciones.index")->with(["message" => "Publicación eliminada correctamente"]);
    }
}
