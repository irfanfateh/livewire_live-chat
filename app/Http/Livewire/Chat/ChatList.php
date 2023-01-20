<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    public $listeners=['getChat','refreshList'];
    public $conversations;
    public $activeConversation=0;
    public $conversationReceiver=0;
    public function mount(){
        $this->refreshList();
    }
    public function refreshList(){
        $this->conversations=Conversation::where('user_one',Auth::user()->id)
        ->orWhere('user_two',Auth::user()->id)->get();
    }
    public function getUser($conversation){
        if($conversation->user_one==Auth::id()){
            return User::find($conversation->user_two);
        }else{
            return User::find($conversation->user_one);
        }
    }
    public function render()
    {
        return view('livewire.chat.chat-list');
    }
    public function getChat($id){
        $conversation=Conversation::find($id);
        $this->emit('setUser',$this->getUser($conversation));
        $this->messageSeen($conversation);
        $this->refreshList();
    }
    public function messageSeen($conversation){
         // message seen
         $counts=Message::where([
            ['conversation_id',$conversation->id],
            ['user_id',$this->getUser($conversation)->id]
        ])->update(['read'=>true]);
    }
}
