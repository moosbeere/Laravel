<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $string;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        $this->string = $text;
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
                    ->with(['text' => $this->string])
                    ->view('mails.test-mail');
    }
}
