<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserEdit extends Notification
{
    use Queueable;

    private $user;
    private $pass_changed;
    private $new_password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $pass_changed, $new_password)
    {
        $this->user = $user;
        $this->pass_changed = $pass_changed;
        $this->new_password = $new_password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->greeting('Hello, friend!')
            ->line('Your account data was edited!')
            ->line('Your current name: ' . $this->user->first_name)
            ->line('Your current email: ' . $this->user->email)
            ->line('Your new password: ' . $this->passChanger())
            ->from('luceatlux7@gmail', 'Don Key')
            ->action('Go to Tasker!', env('APP_URL'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function passChanger()
    {
        if($this->pass_changed){
            return $this->new_password;
        }else{
            return 'current password is actual';
        }
    }
}
