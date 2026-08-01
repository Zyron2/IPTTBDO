<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewApplyProtectionRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Application $application)
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
            ->subject('New IP Protection Application Received')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new IP protection application has been submitted and is pending evaluation.')
            ->line('**Application Details:**')
            ->line('Tracking Number: ' . $this->application->tracking_no)
            ->line('Applicant: ' . $this->application->submittedBy?->name)
            ->line('Title: ' . $this->application->title)
            ->action('View Application', route('applications.show', $this->application))
            ->line('Please review the application in your inbox for update/confirmation.');
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
            'message' => 'New IP protection application received — pending evaluation',
        ];
    }
}
