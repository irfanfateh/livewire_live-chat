<div>
    @if($currentConversation!=0)
    <div class="container flex flex-row px-2 pb-1 border-b-2">
        <div class="pt-3">
            <img wire:click="backConversation" class="cursor-pointer" src="https://img.icons8.com/ios-filled/50/00000030/long-arrow-left.png" />
        </div>
        
        <img class="px-2" src="https://ui-avatars.com/api/?name=@if($receiver){{$receiver->name}}@endif&rounded=true&size=50">
        <div class="ml-auto px-2 pt-2">
            <img src="https://img.icons8.com/color/28/null/info--v1.png" />
        </div>
    </div>
    <!-- chat -->
    <div class="container h-[28rem] bg-gray-100 overflow-scroll" id="content">
        @foreach($messages as $message)
        @if($message->user_id==Auth::id())
        <div class="ml-auto w-4/5 flex">
            <div class="inline-block ml-auto bg-indigo-200 p-2 m-2 rounded">
                <span>{{$message->body}}</span><br>
                <div class="flex justify-end">
                    <span class="text-sm">{{$message->created_at}}</span>
                    <div class="px-2 pt-1">
                        <img src="https://img.icons8.com/ios-filled/13/000000/checkmark--v1.png" />
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="mr-auto w-4/5 flex">
            <div class="inline-block mr-auto bg-gray-200 p-2 m-2 rounded">
                <span>{{$message->body}}</span>
                <div class="flex justify-end">
                    <span class="text-sm">{{$message->created_at}}</span>
                    <div class="px-2 pt-1">
                        <img src="https://img.icons8.com/ios-filled/13/000000/checkmark--v1.png" />
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <!-- send -->
    <div class="container flex">
        <input wire:model.defer="newMsg" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="write message" required>
        <button class="px-4 text-blue-600 font-bold" wire:click="sendMsg">Send</button>
    </div>

    <!-- if conversation is not opened -->
    @else
    <div class="md:block hidden ">
        <img class="mx-auto sm:mt-32" src="https://img.icons8.com/doodle/150/null/empty-box.png"/>
        <p class="text-center font-bold">No Conversation selected yet!</p>
    </div>
    @endif
    <script>
        var element = document.getElementById("content");
            element.scrollTo(0, element.scrollHeight);
    </script>
</div>