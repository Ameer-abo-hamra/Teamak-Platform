<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeInvitation extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct(
        public string $invitationLink,
        public string $companyName,
        public string $job_title,
        public string $department,
        public string $description
    ) {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You are invited to join ' . $this->companyName)
            ->view('emails.employee-invitation', [
                'link' => $this->invitationLink,
                'company' => $this->companyName,
                'email' => $notifiable->routeNotificationFor('mail'),
                'job_title' => $this->job_title,
                'department' => $this->department,
                'description' => $this->description
            ]);
    }
}
