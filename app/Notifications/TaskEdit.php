<?php

namespace App\Notifications;

use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskEdit extends Notification
{
    use Queueable;

    private $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
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
        //WARNING! This notification use custom mail-layout (as demo).
        return (new MailMessage)
                    ->greeting('Hello, friend!')
            ->from('luceatlux7@gmail', 'Don Key')
            ->view('mail.edit_task_mail', ['task' => $this->task, 'task_status' => $this->taskStatusRender($this->task->status)]);
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

    public function taskStatusRender($status)
    {
        if($status == 0){
            return ' Awaits moderation';
        }elseif ($status == 1){
            return ' In process';
        }elseif ($status == 2){
            return ' Decline';
        }elseif ($status == 3){
            return ' Successfully completed';
        }
    }
}
