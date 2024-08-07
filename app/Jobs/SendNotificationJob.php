<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type;
    protected $topicOrToken;
    protected $title;
    protected $body;

    public function __construct($type, $topicOrToken, $title, $body)
    {
        $this->type = $type;
        $this->topicOrToken = $topicOrToken;
        $this->title = $title;
        $this->body = $body;
    }

    public function handle()
    {
        if ($this->type === 'topic') {
            sendNotificationToTopic($this->topicOrToken, $this->title, $this->body);
        } elseif ($this->type === 'token') {
            sendNotification($this->topicOrToken, $this->title, $this->body);
        }
    }
}
