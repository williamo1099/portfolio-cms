<?php

namespace App\Services;

use App\Models\Mail;

class MailService
{
    /**
     * Fetch mails filtered by status and ordered by newest first
     * 
     * @param ?string $status
     * @param ?int $perPage
     */
    public function getMails(?string $status = '', ?int $perPage = null)
    {
        $query = Mail::latest()->ofStatus($status);
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Count the number of mails by status.
     * 
     * @return array
     */
    public function getMailCount(): array
    {
        return Mail::selectRaw('status, COUNT(*) AS total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    }

    /**
     * Create a new mail.
     * 
     * @param array $data
     * @return Mail
     */
    public function createMail(array $data): Mail
    {
        return Mail::create($data);
    }
}
