<x-layout>
    @auth
        <div class="main__left">
            <x-left-menu />
        </div>
        <div class="main__right">

            <x-backlog :countTasks=$countTasks :backlog=$backlog>
            </x-backlog>
            {{-- <x-task-info /> --}}

        </div>
    @endauth
</x-layout>
