<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class TeamInvited extends Notification
{
    use Queueable;

    private $brand;
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["email"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSlack($notifiable)
    {
        $notif = $this->notif;
        $content = "Notification IPN JV:".$notif['type'] ."\n";
        $content .= "data:".$notif['data'];

        return (new SlackMessage)
            ->success()
            ->to($notif['channel'])
            ->content($content);
            // ->attachment(function ($attachment) use ($notifiable) {
            //     $attachment->title($notifiable->email, $notifiable->email)
            //                ->fields([
            //                     'Plan'    => $notifiable->email,
            //                     'Country' => $notifiable->email
            //                 ]);
            // });;
    }
     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->notif;
    }
}
