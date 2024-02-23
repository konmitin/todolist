<?php

require("db.php");

$get_backlog = "SELECT * FROM todo"; // строка с запросом

$response = $connection->query($get_backlog);
$backlog = $response->fetch_all(MYSQLI_ASSOC);

$count_backlog = count($backlog);

$backlog_item = <<<ITEM
    <div class="backlog__item">
        <div class="backlog__left">
        <label class="backlog__label">
            <input type="checkbox" class="backlog__checkbox"/>
            <span class="backlog__psevdo"></span>
        </label>
        <p class="backlog__description">$name</p>
        </div>
        <div class="backlog__date-box date-box">
        <p class="date-box__date">$enddate</p>
        </div>
    </div>
ITEM;
?>

<div class="backlog__box">
    <div class="backlog__header">
    <h3 class="backlog__title title_h3">Backlog</h3>
    <p class="backlog__check title_h3"><?php echo $count_backlog; ?></p>
    </div>
    <div class="backlog__list">
        <?php for($i=0; $i < $count_backlog; $i++): ?>
            <div class="backlog__item">
                <div class="backlog__left">
                <label class="backlog__label">
                    <input 
                    type="checkbox" 
                    class="backlog__checkbox"
                    <?php if($status = $backlog[$i]['status']) {
                            echo "checked";
                        }
                    ?>
                    />
                    <span class="backlog__psevdo"></span>
                </label>
                <p class="backlog__description"><?= $name = $backlog[$i]['name'];?></p>
                </div>
                <div class="backlog__date-box date-box">
                <p class="date-box__date"><?= $enddate = $backlog[$i]['enddate'];?></p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <button class="backlog__more">...</button>
</div>