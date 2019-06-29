<?php
    $variable = 'fds';

    if (is_bool($variable)) {
        $variable = 'true';
        $type = "boolean";
        $desc = "логический тип";
    } elseif (is_float($variable)) {
        $type = "float";
        $desc = "вещественное число";
    } elseif (is_int($variable)) {
        $type = "integer";
        $desc = "целое число";
    } elseif (is_string($variable)) {
        $type = "string";
        $desc = "строка";
    } elseif (is_null($variable)) {
        $type = "null";
        $desc = "NULL тип";
    } else {
        $type = "other";
        $desc = "Массивы, объекты, ресурсы";
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bPHP - 1.1.1</title>
</head>
<body>
    <p>
        <?=" $variable is $type <hr> $desc";?>
    </p>
</body>
</html>