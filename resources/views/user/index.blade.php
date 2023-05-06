<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Tabela korisnika
        </h2>
    </x-slot>

    <div class="container mt-5 offset-3 col-6">


        <table class="table ">
            <thead class="offset-3">

            <th class="">Ime</th>
            <th class="text-center"></th>
            </thead>
            <tbody>
            @foreach ($users as $user)


        <tr>
                    <td class="col-8">{{ $user->name }}</td>

                    <td class="text-center">
                        <form method="POST" action="{{ route('users.add-friend', $user) }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                            <input type="hidden" name="friend_id" value="{{$user->id}}">
                            <button class="btn btn-primary" type="submit">Dodaj</button>
                        </form>

                    </td>

                </tr>

            @endforeach
            </tbody>

        </table>

            {{ $users->links() }}

    </div>


</x-app-layout>
