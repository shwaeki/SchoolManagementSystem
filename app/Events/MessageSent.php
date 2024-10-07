<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent  implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct( public array $data, public string $type)
    {
        //
    }


    public function broadcastOn()
    {
        if ($this->type === "student") {
            return new PrivateChannel('chat.student.' . $this->data['student_id']);
        } elseif ($this->type === "class") {
            return new PrivateChannel('chat.class.' . $this->data['year_class_id']);
        }

    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'type' => $this->type,
        ];
    }
}
