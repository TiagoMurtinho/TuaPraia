<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FlagClicked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('flags');
    }

    public function broadcastAs(): string
    {
        return 'flag-clicked';
    }
}
