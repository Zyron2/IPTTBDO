<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BizDevUpdate extends Notification
{
    use Queueable;

    public function __construct(public Application $application, public string $message, public string $subject = 'Business Development & Incubation Update')
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
            ->subject($this->subject)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->message)
            ->line('Tracking Number: ' . $this->application->tracking_no)
            ->action('View Request', route('applications.show', $this->application))
            ->line('Please check your application for more details.');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'tracking_no' => $this->application->tracking_no,
            'message' => $this->message,
        ];
    }
}
