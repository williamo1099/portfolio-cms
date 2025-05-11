<?php

namespace App\Livewire\Mail;

use App\Services\CurriculumVitaeService;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Mails')]

class Index extends Component
{
    use HasLogging;

    public string $title;
    public array $breadcrumbs;

    /**
     * Boot the component and inject properties.
     * 
     * @param CurriculumVitaeService $service
     * @return void
     */
    public function boot(): void
    {
        // Initialize page title and breadcrumbs.
        $this->title = 'Mails';
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('home.index')],
            ['label' => 'Mails'],
        ];
    }

    /**
     * Render the mail index view.
     * This reuses the same view as the create form.
     * 
     * @return View
     */
    public function render(): View
    {
        return view('livewire.mail.index');
    }
}
