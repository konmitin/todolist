<?php 

require("source/classes.php");
require("php/db.php");

?>

<!DOCTYPE html>
<html lang="ru">
  <?php include_once("views/head.html");?>
  
  <body>
    <div class="wrapper">

    <header class="header">
      <div class="header__container">
        <div class="header__title-block">
          <a href="/" class="header__title">ToDoList</a>
        </div>
        <div class="header__auth-block">
          <?php if($_SESSION['login']) { ?>
            <a href="#" class="header__auth"><?= $_SESSION['login'] ?></a>
            <a href="#" class="header__auth" data-type="logout">Выход</a>
          <?php } else { ?>
            <a href="#" class="header__auth" data-type="login">Вход</a>
            <a href="#" class="header__auth" data-type="reg">Регистрация</a>
          <?php } ?>
          
        </div>
      </div>
    </header>
      
      <main class="main">
        <div class="main__container">
          <div class="main__left">
            <?php include_once("views/menu.php"); ?>
          </div>
          <div class="main__right">
            <?php include_once("views/backlog.php");?>
          </div>
        </div>
      </main>
    </div>

    <?php include_once("views/components/auth-form.html");?>
  </body>

  <?php include_once("source/scripts.php"); ?>

  <script src="js/main.min.js"></script>
</html>


