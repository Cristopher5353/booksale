<?php

namespace App\Repositories;

use App\Models\User;

class ProfileRepository {
    public function getProfileById(int $id) : User {
        return User::find($id);
    }

    public function updateProfile(User $user) : void {
        $user->update();
    }
}