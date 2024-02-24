<?php 

include_once("php/db.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ToDoList</title>

    <link rel="stylesheet" href="css/style.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="wrapper">
      <header class="header">
        <div class="header__container container">
          <h1 class="header__title">ToDoList</h1>
        </div>
      </header>

      <main class="main">
        <div class="main__container container">
          <div class="creation main__creation">
            <form data-form= "addToDo" class="creation__form creation-form" action="php/addtodo.php" method="post">
              <div class="creation-form__item">
                <h3 class="creation-form__title title_h3">What to do</h3>
                <div class="creation-form__input-box">
                  <input name="name" type="text" class="creation-form__input" />
                </div>
              </div>
              <div class="creation-form__item">
                <h3 class="creation-form__title title_h3">When to do</h3>
                <div class="creation-form__input-box">
                  <!-- <label for="dateForToDo" class="creation-form__label"></label> -->
                  <input
                    type="date"
                    id="dateForToDo"
                    name="enddate"
                    class="creation-form__input"
                  />
                </div>
              </div>
              <div class="creation-form__buttons">
                <button
                  class="creation-form__button creation-form__button-add"
                  type="submit"
                >
                  add task</button
                ><button
                  class="creation-form__button creation-form__button-cancel"
                  type="button"
                >
                  cancel
                </button>
              </div>
            </form>
          </div>
          <div class="backlog main__backlog">
            <div class="backlog__box">
              <div class="backlog__header">
                <h3 class="backlog__title title_h3">Backlog</h3>
                <p class="backlog__check title_h3"><?php echo $count_backlog; ?></p>
              </div>
              <div class="backlog__list">
                <?php include_once("php/listload.php"); ?>
              </div>
              <button class="backlog__more">...</button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>

  <script src="js/main.min.js"></script>
</html>


