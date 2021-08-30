<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $seasonsQuantity;
    public $episodesQuantity;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $seasonsQuantity, $episodesQuantity)
    {
        $this->name = $name;
        $this->seasonsQuantity = $seasonsQuantity;
        $this->episodesQuantity = $episodesQuantity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.new-serie');
    }
}
