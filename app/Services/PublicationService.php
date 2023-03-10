<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PublicationRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Publication;

class PublicationService {
    protected $publicationRepository;

    public function __construct(PublicationRepository $publicationRepository) {
        $this->publicationRepository = $publicationRepository;
    }

    public function getPublications() : Collection {
        return $this->publicationRepository->getPublications();
    }

    public function savePublication(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2000000000',
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if($request->hasfile("photo")) {
            $image = $request->file("photo");
            $nameImage = "publication_".time().$image->getClientOriginalName();
            $newRoute = public_path("images/publications/".$nameImage);
            copy($image->getRealPath(), $newRoute);

            $publication = new Publication();
            $publication->title = $request->input("title");
            $publication->description = $request->input("description");
            $publication->image = $nameImage;
            $publication->user_id = Auth::user()->id;

            $this->publicationRepository->savePublication($publication);
        }
    }

    public function getPublicationById(int $id) : Publication {
        return $this->publicationRepository->getPublicationById($id);
    }

    public function updatePublication(Request $request, int $id) {
        if($request->hasfile("photo")) {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required|max:2000000000',
                'photo' => 'required|image|mimes:jpeg,png,jpg'
            ]);

            $image = $request->file("photo");
            $nameImage = "publication_".time().$image->getClientOriginalName();
            $newRoute = public_path("images/publications/".$nameImage);
            copy($image->getRealPath(), $newRoute);

            $publication = $this->publicationRepository->getPublicationById($id);

            $urlPhotoPublication = $publication->image;
            $imagePath = public_path("images/publications/".$urlPhotoPublication);
            unlink($imagePath);

            $publication->title = $request->input("title");
            $publication->description = $request->input("description");
            $publication->image = $nameImage;

            $this->publicationRepository->updatePublication($publication);

        } else {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required|max:2000000000',
            ]);

            $publication = $this->publicationRepository->getPublicationById($id);

            $publication->title = $request->input("title");
            $publication->description = $request->input("description");

            $this->publicationRepository->updatePublication($publication);
        }
    }

    public function deletePublication(int $id) : void {
        $publication = $this->publicationRepository->getPublicationById($id);
        $urlPhotoPublication = $publication->image;
        $imagePath = public_path("images/publications/".$urlPhotoPublication);
        unlink($imagePath);

        $this->publicationRepository->deletePublication($publication);
    }
}