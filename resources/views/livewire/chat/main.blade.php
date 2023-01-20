<div>
    <div class="container  h-[32rem] my-5 mx-auto bg-green-200">
        <div class="grid  md:grid-cols-4">
            <div class="md:col-span-2 lg:col-span-1 border-2 p-2 bg-white">
                @livewire('chat.chat-list')
            </div>
            <div class="md:col-span-2 lg:col-span-3 border-2 p-2 bg-white">
                @livewire('chat.chat-box',['key'=>$key])
            </div>
        </div>
    </div>
</div>