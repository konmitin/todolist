@foreach ($list as $todo)
    <x-backlog.item :todo=$todo></x-backlog.item>
@endforeach
