<?php
session_start();

$backlog = Todo::get($DB);

?>


<div class="backlog main__backlog">
    <div class="backlog__box">
        <div class="backlog__header">
            <h3 class="backlog__title title_h3">Backlog</h3>
            <p class="backlog__check title_h3"><?= count($backlog) ?></p>
        </div>
        <div class="backlog__list">
            <?php foreach($backlog as $todo): ?>
                <div class="backlog__item <?php if($todo->getStatus()) echo '_succesful'?>"
                    data-id="<?=$id = $todo->getId()?>"
                >
                    <label class="backlog__label">
                        <input 
                        type="checkbox" 
                        class="backlog__checkbox"
                        <?php if($todo->getStatus()) {
                                echo "checked";
                            }
                        ?>
                        />
                        <span class="backlog__psevdo"></span>
                    </label>
                    <div class="backlog__desc-block">
                        <p class="backlog__description"><?= $name = (string)$todo->getName();?></p>
                    </div>
                    <div class="backlog__date-box date-box">
                        <p class="date-box__date"><?= $enddate = $todo->getEnddate();?></p>
                    </div>
                    <button class="backlog__delete" type="button" data-type="deleteTask"></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="backlog__more">...</button>
    </div>
</div>


    
