<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $textString;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textString)
    {
        $this->textString = $textString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@polytech.ru')
            ->to('moosbeere_O@mail.ru')
            ->with([
                'textString' => $this->textString,
            ])
            ->view('mails.test-mail');
    }
}
