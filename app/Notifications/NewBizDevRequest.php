<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewBizDevRequest extends Notification
{
    use Queueable;

    public function __construct(public Application $application)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Business Development & Incubation Request')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new business development / incubation request has been received and is pending evaluation.')
            ->line('Tracking Number: ' . $this->application->tracking_no)
            ->line('Title: ' . $this->application->title)
            ->action('View Request', route('applications.show', $this->application))
            ->line('Please review the request and set the meeting decision.');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'tracking_no' => $this->application->tracking_no,
            'message' => 'New business development / incubation request received — pending evaluation',
        ];
    }
}
