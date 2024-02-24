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

<?php for($i=0; $i < $count_backlog; $i++): ?>
    <div class="backlog__item">
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
        <div class="backlog__desc-block">
            <p class="backlog__description"><?= $name = (string)$backlog[$i]['name'];?></p>
        </div>
        <div class="backlog__date-box date-box">
            <p class="date-box__date"><?= $enddate = $backlog[$i]['enddate'];?></p>
        </div>
        <button class="backlog__delete" type="button"></button>
    </div>
<?php endfor; ?>
    
