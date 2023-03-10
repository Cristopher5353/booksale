<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Publication;

class PublicationRepository {
    public function getPublications() : Collection {
        return Publication::all();
    }

    public function savePublication(Publication $publication) : void {
        $publication->save();
    }

    public function getPublicationById(int $id) : Publication {
        return Publication::find($id);
    }

    public function updatePublication(Publication $publication) : void {
        $publication->update();
    }

    public function deletePublication(Publication $publication) : void {
        $publication->delete();
    }
}