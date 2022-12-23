<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $attributes;
    public $string_birthday;
    public $sex;
    public $job;

    public function __construct($attributes,$string_birthday,$sex,$job)
    {
        $this->attributes = $attributes;
        $this->string_birthday = $string_birthday;
        $this->sex = $sex;
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->View('mail.from')->text('mail.from');
    }
}
