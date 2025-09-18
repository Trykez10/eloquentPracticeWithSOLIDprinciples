<?php

namespace App\Events;

use App\Models\PostModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProcessUpdateTask
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $oldVal;
    public $updates;
    public function __construct(PostModel $data, array $updates)
    {
        $this->data = $data;
        $this->updates = $updates;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
