<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class svvadmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public $data;
    public $name;

    public function __construct($name)
    {
        // $this->data = $data;
        $this->name = $name;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->from('info@studiovimana.com')->view('email.contact')
            ->with('name', $this->name);

        // $address = 'ignore@batcave.io';
        // $name = 'Studio Vimana';
        // $subject = 'Asunto';

        // return $this->view('email.contact')
        //             ->from($address, $name)
        //             ->cc($address, $name)
        //             ->bcc($address, $name)
        //             ->replyTo($address, $name)
        //             ->subject($subject);

    }
}
