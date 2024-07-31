<?php 

require("source/classes.php");
require("php/db.php");

?>

<!DOCTYPE html>
<html lang="ru">
  <?php include_once("views/head.html");?>
  
  <body>
    <div class="wrapper">

      <?php include_once("views/header.html");?>
      
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


