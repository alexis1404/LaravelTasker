<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CurrentTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task_name;
    public $textmessage;
    public $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task_name, $textmessage, $attach)
    {
        $this->task_name = $task_name;
        $this->textmessage = $textmessage;
        $this->attach = $attach;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->attach) {
            return $this->view('mail.current_task_mail')
                ->from('tasker@gmail.com', 'Tasker')
                ->attach($this->attach->getRealPath(), [
                    'as' => $this->attach->getClientOriginalName(),
                    'mime' => $this->attach->getMimeType()
                ]);
        }else{
            return $this->view('mail.current_task_mail')
                ->from('tasker@gmail.com', 'Tasker');
        }
    }
}
