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
            <?php 
                $backlog = Todo::get($DB);
                include_once("views/backlog.php");
            ?>
          </div>
        </div>
      </main>
    </div>
  </body>

  <?php include_once("source/scripts.php"); ?>

  <script src="js/main.min.js"></script>
</html>


