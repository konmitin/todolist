<?php session_start(); ?>

<div class="menu">
  <ul class="menu__list">
    <li class="menu__item">
      <a
        data-sort="all"
        href="#"
        class="menu__item-link _active">
        Все задачи
      </a>
    </li>
    <li class="menu__item">
      <a
        data-sort="active"
        href="#"
        class="menu__item-link ">
        Активные
      </a>
    </li>
    <li class="menu__item">
      <a
        data-sort="success"
        href="#"
        class="menu__item-link ">
        Выполненные
      </a>
    </li>
    <li class="menu__item">
      <a
        data-sort="fail"
        href="#"
        class="menu__item-link ">
        Просроченные
      </a>
    </li>
  </ul>
  <?php if(!empty($_SESSION['user_id'])) {?>
  <ul class="menu__list">
    <li class="menu__item">
      <button
        data-type="formTask"
        class="menu__item-link menu__item-btn">
        Добавить задачу
      </button>
    </li>
  </ul>
  <?php }?>
</div>