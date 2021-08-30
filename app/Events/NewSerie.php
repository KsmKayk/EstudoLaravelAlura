<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $serieName;
    public $seasonsQuantity;
    public $episodesQuantity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($serieName, $seasonsQuantity, $episodesQuantity)
    {
        $this->serieName = $serieName;
        $this->seasonsQuantity = $seasonsQuantity;
        $this->episodesQuantity = $episodesQuantity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
