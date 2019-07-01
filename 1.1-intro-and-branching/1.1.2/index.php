<?php 
$dayN = date("N");
$hours = date("H");

switch ($dayN) {
    case 1:
        $weekDay = 'Понедельник';
        break;
    case 2:
        $weekDay = 'Вторник';
        break;
    case 3:
        $weekDay = 'Среда';
        break;
    case 4:
        $weekDay = 'Четверг';
        break;
    case 5:
        $weekDay = 'Пятница';
        break;
    case 6:
        $weekDay = 'Суббота';
        break;
    case 7:
        $weekDay = 'Воскресение';
        break;
    
    default:
        $weekDay = 'Такого дня нет :(';
        break;
};

if ( $hours >= 6 && $hours < 11 ) {
    $greeting = '<p>Доброе утро!</p>';
    $img = 'img/morn.jpg';
} elseif ( $hours >= 11 && $hours < 18 ) {
    $greeting = '<p>Добрый день!</p>';
    $img = 'img/day.jpg';
} elseif ( $hours >= 18 && $hours < 23 ) {
    $greeting = '<p>Добрый вечер!</p>';
    $img = 'img/evening.jpg';
} else {
    $greeting = '<p>Доброй ночи!</p>';
    $img = 'img/night.jpg';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bPHP - 1.1.1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="img" style="background-image: url(<?= $img; ?>)">
        <div class="greeting">
            <h1>
                <?= $greeting; ?>
                <?= "<p>Сегодня $weekDay</p>"; ?>
            </h1>
        </div>
    </div>
</body>
</html>