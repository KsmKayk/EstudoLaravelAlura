<?php

namespace App\Listeners;

use App\Events\NewSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendNewCreatedSerieEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSerie  $event
     * @return void
     */
    public function handle(NewSerie $event)
    {
        $name = $event->$serieName;
        $seasons_quantity = $event->$seasonsQuantity;
        $episodes_quantity = $event->$episodesQuantity;

        $users = User::All();
        foreach ($users as $index => $user) {
            $multiplyer = $index + 1;
            $email = new \App\Mail\NewSerie($name, $seasons_quantity, $episodes_quantity);
            $email->subject = 'Nova Série adicionada!';
            $when = now()->addSeconds($multiplyer * 10);
            Mail::to($user)->later($when, $email);
        }
    }
}
