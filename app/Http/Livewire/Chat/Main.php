<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Main extends Component
{
    public $key;
    public function mount($key=0){
        $this->key=($key)?$key:0;
    }
    public function render()
    {
        return view('livewire.chat.main');
    }
}
