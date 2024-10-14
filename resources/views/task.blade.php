<x-layout>
    @if($isAccess)
    <div class="main__left">
        <x-left-menu :type={{ 'task' }} />
    </div>

    
    <div class="task">
        <div class="task__container">
            <div class="task__info">
                <div class="task__info-top">
                    <h4 class="task__title">{{ $task->title }}</h4>
                    <div class="task__stages">

                        @for ($i = 3; $i >= 0; $i--)
                            @php
                                $step = $steps[$i];
                                $left = $step->position == 1 ? true : false;

                                $currentStep = $task->step_id;
                                $isFail = $currentStep == 'dt_failed' ? true : false;

                                if (!$isActive) {
                                    $isActive = $step->id_all == $currentStep ? true : false;

                                    if (!$isActive && $i > 2) {
                                        continue;
                                    }
                                } elseif ($currentStep == 'dt_failed' && $step->id_all == 'dt_success') {
                                    continue;
                                }

                                $right = $step->position == 3 ? true : false;
                            @endphp

                            <button @class([
                                'task__stage',
                                'task__stage_left' => $left,
                                'task__stage_right' => $right,
                                'active' => $isActive,
                                'fail' => $isFail,
                            ]) data-type="taskStage" data-id="{{ $step->id_all }}">
                                {{ $step->title }}
                            </button>
                        @endfor

                    </div>
                    <div class="task__btns">
                        <button class="task__btn" data-type="taskEdit">
                            <img src="/storage/img/pen.svg" alt="">
                        </button>
                        <button class="task__btn" data-type="taskDelete">
                            <img class="task__btn-img" src="/storage/img/trash-task-red.svg" alt="">
                        </button>
                    </div>
                </div>
                <ul class="task__info-list">
                    <li class="task__info-item" data-fid="created_date">
                        <h6 class="task__info-item-title">Создана</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text">{{ $task->created_at->format('d.m.Y') }}</span>
                        </div>
                    </li>
                    <li class="task__info-item" data-fid="deadline">
                        <h6 class="task__info-item-title">Крайний срок</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text">{{ $task->end_date->format('d.m.Y') }}</span>
                        </div>
                    </li>
                    <li class="task__info-item" data-fid="closed_date">
                        <h6 class="task__info-item-title">Закрыта</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text">{{ $task->updated_at->format('d.m.Y') }}</span>
                        </div>
                    </li>
                    {{-- <li class="task__info-item" data-fid="created_by">
                        <h6 class="task__info-item-title">Постановщик</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text">
                                @if ($task->user()->first()->id == $currentUserId)
                                    ВЫ
                                @else
                                    {{ strtoupper($task->user()->first()->name) }}
                                @endif
                            </span>
                        </div>
                    </li> --}}
                    {{-- <li class="task__info-item" data-fid="responsible">
                        <h6 class="task__info-item-title">Ответственный</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text"><?= '22.09.2024' ?></span>
                        </div>
                    </li> --}}
                    <li class="task__info-item" data-fid="group">
                        <h6 class="task__info-item-title">Группа</h6>
                        <div class="task__info-item-main">
                            <div class="task__info-item-main">
                                <span class="task__info-item-text"><?= '22.09.2024' ?></span>
                            </div>
                        </div>

                    </li>
                    <li class="task__info-item" data-fid="status">
                        <h6 class="task__info-item-title">статус</h6>
                        <div class="task__info-item-main">
                            <span class="task__info-item-text"><?= '22.09.2024' ?></span>
                        </div>
                    </li>
                    <li class="task__info-item" data-fid="github_link">
                        <h6 class="task__info-item-title">github link</h6>
                        <div class="task__info-item-main">
                            <img src="'task/img/world.svg'" alt="">
                            <a href="https://github.com/konmitin/todolist" class="task__info-item-text"
                                target="_blank"><?= '22.09.2024' ?></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="task__info task__desc">
                <div class="task__info-top">
                    <h4 class="task__title"><?= 'Описание' ?></h4>
                </div>
                <div class="task__desc-main">
                    <textarea class="task__desc-text"><?= 'Описание задачи...' ?></textarea>
                </div>
            </div>

            <div class="task__edit-btns">
                <button class="task__edit-btn task__edit-btn_save">Сохранить</button>
                <button class="task__edit-btn task__edit-btn_cancel">Отменить</button>
            </div>
        </div>
    </div>
    @else 
     <p>Доступ запрещен</p>
    @endif
</x-layout>
