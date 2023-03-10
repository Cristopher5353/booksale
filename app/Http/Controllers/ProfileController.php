<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    public function editProfile(int $id) {
        $user = $this->profileService->getProfileById($id);
        return view("profiles.edit", compact("user"));
    }

    public function updateProfile(Request $request, int $id) {
        $this->profileService->updateProfile($request, $id);
        return redirect()->route("editProfile", $id)->with(["message" => "Perfil actualizado correctamente"]);
    }

    public function updateImageProfile(Request $request, int $id) {
        $this->profileService->updateImageProfile($request, $id);
        return redirect()->route("editProfile", $id)->with(["message" => "Foto de perfil actualizada correctamente"]);
    }

    public function deleteImageProfile(int $id) {
        $this->profileService->deleteImageProfile($id);
        return redirect()->route("editProfile", $id)->with(["message" => "Foto de perfil eliminada correctamente"]);
    }

    public function editPassword(int $id) {
        $user = $this->profileService->getProfileById($id);
        return view("profiles.editPassword", compact("user"));
    }

    public function updatePassword(Request $request, int $id) {
        $this->profileService->updatePassword($request, $id);
        return redirect()->route("editPassword", $id)->with(["message" => "Contraseña actualizada correctamente"]);
    }
}
