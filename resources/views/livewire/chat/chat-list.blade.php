<div>
    <div class="container flex flex-row pb-1 border-b-2">
        <div class="basis-1/2 px-3 pt-3 text-gray-400 text-2xl">
            <span>Chat</span>
        </div>
        <div class="basis-1/2 px-2">
            <!-- <span>this</span> -->
            <img class="ml-auto" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&rounded=true&size=50">
        </div>
    </div>
    <div class="container h-[32rem] overflow-y-scroll">
        @foreach($conversations as $conversation)
        <div wire:click="$emit('getChat',{{$conversation->id}})" class="flex flex-row cursor-pointer my-1 py-3 bg-gray-100 rounded-[15px] px-2">
            <img src="https://ui-avatars.com/api/?name={{$this->getUser($conversation)->name}}&rounded=true&size=50">
            <div class="px-2">
                <p>{{$this->getUser($conversation)->name}}</p>
                <p>{{ \Illuminate\Support\Str::limit($conversation->messages->last()->body, 15, $end='...') }}</p>
            </div>
            <div class="ml-auto">
                <p class="text-gray-400">{{$conversation->messages->last()->created_at}}</p>
                <p class="pt-2 font-bold text-red-600">{{$conversation->messages->where('read',null)->where('user_id',$this->getUser($conversation)->id)->count()}}</p>
            </div>
        </div>
        @endforeach

    </div>

    <script>
        window.addEventListener('name-updated', event => {
            var element = document.getElementById("content");
            element.scrollTo(0, element.scrollHeight);
        })
    </script>
</div>