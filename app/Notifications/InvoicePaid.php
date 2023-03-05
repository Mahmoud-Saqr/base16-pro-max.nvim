<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;
    private $invoices_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($invoices_id)
    {
        $this -> invoices_id = $invoices_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://first-project.test/invoices_details/'. $this -> invoices_id;

        return (new MailMessage)
                    -> subject('A New Invoice Has Been Added')
                    -> line('A New Invoice Has Been Added')
                    -> action('View Invoice', $url)
                    -> line('Thank you for using our Invoices!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
