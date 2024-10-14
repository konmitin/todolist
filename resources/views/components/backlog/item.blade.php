@php

    $id = $todo['id'];
    $name = $todo['title'];
    $enddate = $todo['end_date'];
    $status = $todo['status'];

    $success = $status == 'success' ? true : false;
    $fail = $status == 'fail' ? true : false;
    $check = $status == 'check' ? true : false;

@endphp

<div @class([
    'backlog__item',
    '_success' => $success,
    '_fail' => $fail,
    '_check' => $check,
]) data-id="{{ $id }}">
    <a href="{{ route('task.view', $id) }}" class="backlog__item-left">
        <div class="backlog__desc-block">
            <p class="backlog__description">{{ $name }}</p>
        </div>
        <div class="backlog__date-box date-box">
            <p class="date-box__date">{{ $enddate }}</p>
        </div>
    </a>

    <div class="backlog__right backlog__btns">

        @if (!$success)
            <button class="backlog__success backlog__btn" data-type="taskSuccess">

                <img class="backlog__delete_img" src="/storage/img/check-task-green.svg" alt="">
            </button>
        @endif

        <button class="backlog__delete backlog__btn" type="button" data-type="deleteTask">
            <img class="backlog__delete_img" src="/storage/img/trash-task-red.svg" alt="">
        </button>
    </div>
</div>
