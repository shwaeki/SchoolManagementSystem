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
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public array $data, public string $type)
    {
        //
    }




    public function broadcastOn()
    {
        if ($this->type === "student") {

            Log::info( $this->data['student_id']);
            return [
                new PrivateChannel("chat.{$this->data["student_id"]}"),
              //  new Channel('chat.student.33'),
             //   new Channel('test-channel'),
            ];
        } elseif ($this->type === "class") {
            return [
                new PrivateChannel('chat.class.' . $this->data['year_class_id']),
                new Channel('chat.class'),
            ];
        }

    }

/*    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'type' => $this->type,
        ];
    }*/
}
