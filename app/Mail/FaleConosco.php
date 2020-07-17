<?php

namespace App\Mail;

use App\Mails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FaleConosco extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mails $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.faleConosco')->subject("Contato pelo Site")->with(
            [
                'name' => $this->mail->name,
                'email' => $this->mail->email,
                'telefone' => $this->mail->telefone,
                'assunto' => $this->mail->assunto,
                'mensagem' => $this->mail->mensagem,
            ]
        );
    }
}
