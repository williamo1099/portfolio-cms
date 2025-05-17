<?php

namespace App\Services;

use App\Exceptions\ValidationFieldException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    /**
     * Update the currently signed-in user profile.
     * 
     * @param array $data
     * @return User
     */
    public function updateProfile(array $data): User
    {
        $user = Auth::user();

        // If password data exists, it means user is changing password.
        if (array_key_exists('password', $data)) {
            if (!Hash::check($data['password'], $user->password)) {
                throw new ValidationFieldException('password', 'Invalid password!');
            }

            $user->password = bcrypt($data['newPassword']);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        return $user;
    }
}
