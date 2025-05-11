<?php

namespace App\Livewire\Mail;

use App\Services\MailService;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Mails')]

class Index extends Component
{
    use HasLogging;

    public string $title;
    public array $breadcrumbs;
    public string $statusFilter = '';

    protected MailService $service;

    /**
     * Boot the component and inject properties.
     * 
     * @param MailService $service
     * @return void
     */
    public function boot(MailService $service): void
    {
        // Initialize the service.
        $this->service = $service;

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
        try {
            // Get mails filtered by status and ordered by newest first.
            $mails = $this->service->getMails($this->statusFilter, 10);

            // Count the number of mails by type.
            $projectCounts = $this->service->getMailCount();
            $unreadCount = $projectCounts['unread'] ?? 0;
            $dismissedCount = $projectCounts['dismissed'] ?? 0;
            $notifiedCount = $projectCounts['notified'] ?? 0;
        } catch (Exception $ex) {
            // Log exception.
            $errorCode = $this->logException('fetching mails', $ex);
            session()->flash('error', "Failed to fetch mails! (Error code : {$errorCode})");

            // Set fallback data.
            $mails = new LengthAwarePaginator(collect(), 0, 5, 1, ['path' => request()->url()]);
            $unreadCount = 0;
            $dismissedCount = 0;
            $notifiedCount = 0;
        }

        return view('livewire.mail.index', compact('mails', 'unreadCount', 'dismissedCount', 'notifiedCount'));
    }

    /**
     * Check if the given status is the currently active filter.
     * 
     * @param string $type
     * @return bool
     */
    public function isActive(string $status): bool
    {
        return $this->statusFilter === $status;
    }

    /**
     * Update the current status filter.
     * If the selected status is already active, reset the filter.
     * 
     * @param string $type
     * @return void
     */
    public function setStatusFilter(string $status): void
    {
        if ($status == $this->statusFilter) {
            $this->statusFilter = '';
            return;
        }

        $this->statusFilter = $status;
    }
}
