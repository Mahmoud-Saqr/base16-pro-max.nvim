<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInvoice extends Notification
{
    use Queueable;
    private $id_send_message;


    /**
     * Create a new notification instance.
     */
    public function __construct($id_send_message)
    {
        $this -> id_send_message = $id_send_message;
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
        $url_send_message = 'http://first-project.test/print_invoice/'. $this -> id_send_message;

        return (new MailMessage)
            -> subject('Share an invoice')
            -> line('Share an invoice')
            -> action('View Invoice', $url_send_message)
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
