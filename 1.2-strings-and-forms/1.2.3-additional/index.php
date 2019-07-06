<?php

//http:// protocol search

$protocol = $_SERVER["HTTP_REFERER"];
$toSearch = 'https://';

if (stripos($protocol, $toSearch) === false) {
    $result = 'Нет';
} else {
    $result = 'Да';
};

if (substr($protocol, 0, strlen($toSearch)) === $toSearch) {
    $res = 'Да';
} else {
    $res = 'Нет';
};

//change date format

$americanFormat = '05-29-1993';
$russianFormat = date('d.m.Y', strtotime($americanFormat)); 

//price format

$price = 100000000000000;
$currency = 'руб.';

$price = number_format($price, 0, '.', ' ') . " $currency";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?="<p>$result</p>";?>
    <?="<p>$res</p>";?>
    <?="<p>$russianFormat</p>";?>
    <?="<p>$price</p>";?>
</body>
</html>