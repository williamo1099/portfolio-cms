<?php

namespace App\Services;

use App\Models\Mail;
use Exception;

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
        $allowedStatuses = ['dismissed', 'notified'];
        if (!in_array($status, $allowedStatuses)) {
            $status = 'unread';
        }

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

    /**
     * Set the mail status.
     * 
     * @param int $mailId
     * @param string $status
     * @return Mail
     */
    public function setMailStatus(int $mailId, string $status): Mail
    {
        $allowedStatuses = ['unread', 'dismissed', 'notified'];
        if (!in_array($status, $allowedStatuses)) {
            throw new Exception('Status is unknown.');
        }

        $mail = Mail::findOrFail($mailId);
        $mail->status = $status;
        $mail->save();
        return $mail;
    }

    /**
     * Delete the mail (soft delete).
     * 
     * @param int $mailId
     * @return Project
     */
    public function deleteMail(int $mailId): Mail
    {
        $project = Mail::findOrFail($mailId);
        $project->delete();
        return $project;
    }
}
