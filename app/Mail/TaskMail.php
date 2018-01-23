<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $textmail;
    public $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textmail, $attach)
    {
        $this->textmail = $textmail;
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
            return $this->view('mail.task_mail')
                ->from('tasker@gmail.com', 'Tasker')
                ->attach($this->attach->getRealPath(), [
                    'as' => $this->attach->getClientOriginalName(),
                    'mime' => $this->attach->getMimeType()
                ]);
        }else{
            return $this->view('mail.task_mail')
                ->from('tasker@gmail.com', 'Tasker');
        }
    }
}
