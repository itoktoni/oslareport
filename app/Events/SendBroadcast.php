<?php

namespace App\Events;

use App\Dao\Enums\Core\NotificationType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MBarlow\Megaphone\Types\BaseAnnouncement;

class SendBroadcast implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $data;

    public $type;

    public $user_id;

    /**
     * Create a new event instance.
     */
    public function __construct(BaseAnnouncement $data, $type = NotificationType::Info, $user_id = null)
    {
        $this->data = $data;
        $this->type = $type;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('broadcast'),
        ];
    }

    public function broadcastAs()
    {
        return 'bell';
    }
}
