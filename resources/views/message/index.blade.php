<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Chat
        </h2>
    </x-slot>

    <div class="container mt-5 offset-2 col-8 ">
        <div class="card" style=";">
            <div class="list-group list-group-flush">
                <div class="list-group-item"><img style="height: 50px;width: 50px; display: inline;" class=" " src="{{ asset('avatar.png') }}" >
                    @if($friendship->user_id==\Illuminate\Support\Facades\Auth::id())
                        {{ $friendship->friend->name}}
                    @else
                    {{ $friendship->user->name}}</div>
                @endif
               @foreach($messages as $message)
                <div class="list-group-item">
                    @if($message->sender_id==\Illuminate\Support\Facades\Auth::id())
                        <div class="bg-info rounded float-end">{{$message->message}}</div>
                    @else
                        <div class="bg-light rounded float-start">{{$message->message}}</div>
                    @endif

                </div>
                @endforeach
                <div class="list-group-item">
                    <form class="form-control" action="{{route('message.send')}}" method="POST">
                        @csrf
                        <input type="hidden" name="sender_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                        <input type="hidden" name="receiver_id"
                    @if($friendship->user->id==\Illuminate\Support\Facades\Auth::id())
                        value= "{{ $friendship->friend->id}}"
                    @else
                                   value="{{ $friendship->user->id}}"
                @endif >
                        <textarea  name="message" placeholder="Napisite poruku"></textarea>
                        <button class="btn btn-primary " type="submit">Posalji</button>
                    </form>


                </div>
            </div>
        </div>

    </div>


</x-app-layout>
