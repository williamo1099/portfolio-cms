<?php

namespace App\Livewire\Forms;

use App\Exceptions\ValidationFieldException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Validate('required')]
    public string $name;

    #[Validate('required', 'email')]
    public string $email;

    #[Validate('nullable')]
    public string $password = '';

    #[Validate]
    public string $newPassword = '';

    #[Validate]
    public string $newPasswordConfirmation = '';

    /**
     * Add additional conditional rules for password related inputs.
     * 
     * @return array
     */
    protected function rules(): array
    {
        $rules = [];

        if ($this->password != '') {
            $rules['newPassword'] = 'required';
            $rules['newPasswordConfirmation'] = 'required|same:newPassword';
        }

        return $rules;
    }

    /**
     * Set current profile with logged-in user.
     * 
     * @return void
     */
    public function setProfile(): void
    {
        $user = Auth::user();

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    /**
     * Update the currently signed-in user profile.
     * 
     * @return bool
     */
    public function update(): bool
    {
        try {
            $validated = $this->validate();
            $user = app(\App\Services\ProfileService::class)->updateProfile($validated);
            return $user instanceof User;
        } catch (ValidationFieldException $ex) {
            $this->addError($ex->getField(), $ex->getMessage());
            return false;
        }
    }
}
