<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TechTransferUpdate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Application $application, public string $message, public string $subject = 'Tech Transfer Update')
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
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

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'tracking_no' => $this->application->tracking_no,
            'message' => $this->message,
        ];
    }
}
