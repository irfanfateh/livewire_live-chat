<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;
use App\Events\SendMessage;
class ChatBox extends Component
{
    public $currentConversation=0;
    public $messages=null;
    public $newMsg;
    public $receiver;
    public function getListeners(){
        return [
            'echo-private:chat.'.Auth::id().',SendMessage'=>'broadcastReceiver',
            'setUser',
            'getChat',
            'dispatchMessage'
        ];
    }
    public function mount($key){
        if($key!=0){
            $conversation=Conversation::where([
                ['user_one',$key],
                ['user_two',Auth::id()]
            ])->orWhere([
                ['user_one',Auth::id()],
                ['user_two',$key]
            ])->first();
            $this->receiver=User::find($key);
            $this->getChat($conversation->id);
        }
    }
    public function broadcastReceiver($event){
        if($this->currentConversation==$event['conversation_id']){
            $this->getChat($event['conversation_id']);
            $this->emitTo('chat.chat-list','refreshList');
        }else{
            $this->emitTo('chat.chat-list','refreshList');
        }
    }
    public function backConversation(){
         $this->currentConversation=0;
    }
    public function getChat($id){
        $this->currentConversation=$id;
        $this->messages=Message::where('conversation_id',$id)->get();
        $this->dispatchBrowserEvent('name-updated');
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
    public function sendMsg(){
        if($this->newMsg!=''){
            $msg=new Message;
            $msg->conversation_id=$this->currentConversation;
            $msg->body=$this->newMsg;
            $msg->user_id=Auth::id();
            $msg->save();
            $this->getChat($this->currentConversation);
            $this->newMsg="";
            $this->emitSelf('dispatchMessage');
            $this->emitTo('chat.chat-list','refreshList');
        }
    }
    public function setUser(User $user){
        $this->receiver=$user;
    }
    public function dispatchMessage(){
        SendMessage::dispatch(Auth::user(),$this->messages->last(),$this->receiver,Conversation::find($this->currentConversation));
    }
}
