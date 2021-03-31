<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationClient implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastOn()
    {
        return 'ed8ced36474dd91' . $this->id . '298e26874a4f540';
    }

    public function broadcastAs()
    {
        return 'e5a8e0789fcea9u' . $this->id . '6722c8bd7f83329';
    }
}
