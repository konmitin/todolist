<div class="backlog main__backlog">
    <div class="backlog__box">
        <div class="backlog__header">
            <h3 class="backlog__title title_h3">Задачи</h3>
            <p class="backlog__check title_h3">{{ $countTasks }}</p>
        </div>
        <div class="backlog__list">

            @foreach ($backlog as $todo)
                <x-backlog.item :todo=$todo ></x-backlog.item>
            @endforeach

        </div>

        <button class="backlog__more">...</button>
    </div>
</div>
