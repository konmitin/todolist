<div class="menu">
  <ul class="menu__list">
    <li class="menu__item">
      <a 
        href="all.php" 
        class="menu__item-link <?php if($_SERVER['REQUEST_URI'] == "/") {echo "_active";}?>"
      >
        Все задачи
      </a>
    </li>
    <li class="menu__item">
      <a 
        href="#" 
        class="menu__item-link <?php if($_SERVER['REQUEST_URI'] == "/active.php") {echo "_active";}?>"
      >
        Активные
      </a>
    </li>
    <li class="menu__item">
      <a 
        href="#" 
        class="menu__item-link <?php if($_SERVER['REQUEST_URI'] == "/succesful.php") {echo "_active";}?>"
      >
        Выполненные
      </a>
    </li>
    <li class="menu__item">
      <a 
        href="#" 
        class="menu__item-link <?php if($_SERVER['REQUEST_URI'] == "/failed.php") {echo "_active";}?>"
      >
        Просроченные
      </a>
    </li>
  </ul>
</div>
