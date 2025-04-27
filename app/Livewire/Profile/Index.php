<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\ProfileForm;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Profile')]

class Index extends Component
{
    public string $title;
    public array $breadcrumbs;

    public ProfileForm $form;

    /**
     * Boot the component and inject properties.
     * 
     * @return void
     */
    public function boot(): void
    {
        // Initialize page title and breadcrumbs.
        $this->title = 'Profile';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Profile'],
        ];
    }

    /**
     * Initialize the form with the current user.
     * 
     * @return void
     */
    public function mount(): void
    {
        $this->form->setProfile();
    }

    /**
     * Render the profile index view.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.profile.index');
    }

    /**
     * Handle the update submit button click event.
     * 
     * @return void
     */
    public function save(): void
    {
        try {
            // TODO: Add save logic here.
        } catch (Exception $ex) {
            $errorCode = $this->logException('updating profile', $ex);
            session()->flash('error', "Failed to update profile! (Error code : {$errorCode})");
        }
    }
}
