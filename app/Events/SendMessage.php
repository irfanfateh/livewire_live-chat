<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public $message;
    public $receiver;
    public $conversation;
    public function __construct(User $user,Message $message,User $receiver,Conversation $conversation)
    {
        $this->user=$user;
        $this->message=$message;
        $this->receiver=$receiver;
        $this->conversation=$conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastWith(){
        return [
            'user'=>$this->user->id,
            'message'=>$this->message->id,
            'conversation_id'=>$this->conversation->id,
            'receiver'=>$this->receiver->id,
        ];
    }
    public function broadcastOn()
    {
        error_log($this->user);
        return new PrivateChannel('chat.'.$this->receiver->id);
    }
}
