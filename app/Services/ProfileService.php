<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ProfileRepository;
use App\Models\User;

class ProfileService {
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository) {
        $this->profileRepository = $profileRepository;
    }

    public function getProfileById(int $id) : User {
        return $this->profileRepository->getProfileById($id);
    }

    public function updateProfile(Request $request, int $id) {
        $validated = $request->validate([
            'name' => "required|max:255",
            'surname' => "required|max:255",
            'dni' => "required|regex:/[0-9]{8}/",
            'phone' => "required|regex:/[0-9]{9}/",
            'email' => "required|email|max:255"
        ]);

        $user = $this->profileRepository->getProfileById($id);

        $user->name = $request->input("name");
        $user->surname = $request->input("surname");
        $user->dni = $request->input("dni");
        $user->phone = $request->input("phone");
        $user->email = $request->input("email");

        $this->profileRepository->updateProfile($user);
    }

    public function updateImageProfile(Request $request, int $id) {
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if($request->hasfile("photo")) {
            $image = $request->file("photo");
            $nameImage = "userimage_".time().$image->getClientOriginalName();
            $newRoute = public_path("images/users/".$nameImage);
            copy($image->getRealPath(), $newRoute);

            $user = $this->profileRepository->getProfileById($id);

            if($user->image != null) {
                $urlPhotoUser = $user->image;
                $imagePath = public_path("images/users/".$urlPhotoUser);
                unlink($imagePath);
            }

            $user->image = $nameImage;
            $this->profileRepository->updateProfile($user);
        }
    }

    public function deleteImageProfile(int $id) {
        $user = $this->profileRepository->getProfileById($id);

        $urlPhotoUser = $user->image;
        $imagePath = public_path("images/users/".$urlPhotoUser);
        unlink($imagePath);

        $user->image = null;
        $this->profileRepository->updateProfile($user);
    }

    public function updatePassword(Request $request, int $id) {
        $validated = $request->validate([
            'currentPassword' => 'required|current_password',
            'newPassword' => 'required|confirmed|min:8',
        ]);

        $user = $this->profileRepository->getProfileById($id);
        $user->password = Hash::make($request->input("newPassword"));
        $this->profileRepository->updateProfile($user);
    }
}