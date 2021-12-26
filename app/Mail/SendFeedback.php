<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class SendFeedback extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $phone;
    public $name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @param $feedback
     */
    public function __construct(Request $feedback)
    {
        $phone     = $feedback->input('phone');
        $name      = $feedback->input('name');
//        $email     = $feedback->input('email');
        $message   = $feedback->input('feedback');


        $this->phone     = $phone;
        $this->name      = $name;
//        $this->email     = $email;
        $this->message   = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Отзыв от $this->name";

        return $this->view('emails.feedback')
            ->subject($subject)
            ->with([
                'name' => $this->name,
                'phone' => $this->phone,
//                'email' => $this->email,
                'text' => $this->message
            ]);
    }
}
