<?php
session_start();

$userID = $_SESSION['user_id'];
// $lastSort = $_SESSION['last_sort'];
$lastSort = "";
$backlog = Task::getList($userID, $lastSort);

?>


<div class="backlog main__backlog">
    <div class="backlog__box">
        <div class="backlog__header">
            <h3 class="backlog__title title_h3">Задачи</h3>
            <p class="backlog__check title_h3"><?= count($backlog) ?></p>
        </div>
        <div class="backlog__list">
            <?php foreach ($backlog as $todo): ?>
                <div
                    class="backlog__item <?php if ($todo->getStatus() == '1') {
                                                echo '_successful';
                                            } else if ($todo->getStatus() == '2') {
                                                echo '_failed';
                                            } ?>"
                    data-id="<?= $id = $todo->getId() ?>">
                    <label
                        
                        class="backlog__label">
                        <input
                            data-type="taskSuccess"
                            type="checkbox"
                            class="backlog__checkbox"
                            <?php if ($todo->getStatus()) {
                                echo "checked";
                            }
                            ?> />
                        <span class="backlog__psevdo"></span>
                    </label>
                    <div class="backlog__desc-block">
                        <p class="backlog__description"><?= $name = (string)$todo->getTitle(); ?></p>
                    </div>
                    <div class="backlog__date-box date-box">
                        <p class="date-box__date"><?= $enddate = $todo->getEndDate(); ?></p>
                    </div>
                    <button class="backlog__delete" type="button" data-type="deleteTask"></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="backlog__more">...</button>
    </div>
</div>