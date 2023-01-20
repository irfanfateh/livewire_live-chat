<?php

namespace App\Http\Livewire\Chat;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public function mount(){
        $this->users=User::all()->except(Auth::id());
    }
    public function render()
    {
        return view('livewire.chat.create-chat');
    }
}
