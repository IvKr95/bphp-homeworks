<?php

include 'autoload.php';
include 'config/SystemConfig.php';

$fileName = '1';
$obj = new FileAccessModel($fileName);
$objJson = new JsonFileAccessModel($fileName);
$text = ['element4' => 'value1', 'element5' => 'value1', 'element6' => 21];
$text1 = 'I am the text';
print_r($obj->write($text1));
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
    <div>

    </div>
</body>
</html>