<div class="menu">
    <ul class="menu__list">
        <li class="menu__item">
            <a data-sort="all" href="#" class="menu__item-link _active">
                Все задачи
            </a>
        </li>
        <li class="menu__item">
            <a data-sort="open" href="#" class="menu__item-link ">
                Активные
            </a>
        </li>
        <li class="menu__item">
            <a data-sort="check" href="#" class="menu__item-link ">
                На проверке
            </a>
        </li>
        <li class="menu__item">
            <a data-sort="success" href="#" class="menu__item-link ">
                Выполненные
            </a>
        </li>
        <li class="menu__item">
            <a data-sort="fail" href="#" class="menu__item-link ">
                Проваленные
            </a>
        </li>
    </ul>
    @auth
        <ul class="menu__list">
            <li class="menu__item">
                <button data-type="formTask" class="menu__item-link menu__item-btn">
                    Добавить задачу
                </button>
            </li>
        </ul>
    @endauth
</div>
