<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <ul class="mx-auto my-3 bg-white w-1/2 ">
        @foreach($users as $user)
        <li class="p-3 border-2">
            <a class="flex" href="{{url('/chat'.$user->id)}}">
                <img src="https://ui-avatars.com/api/?name={{$user->name}}&rounded=true&size=50" alt="">
                <span class="m-3">{{$user->name}}</span>
                <span class="my-3 ml-auto">{{$user->email}}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
