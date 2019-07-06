<?php

$firstName = mb_convert_case(trim($_POST['firstName']), MB_CASE_TITLE, "UTF-8");
$middleName = mb_convert_case(trim($_POST['middleName']), MB_CASE_TITLE, "UTF-8");
$lastName = mb_convert_case(trim($_POST['lastName']), MB_CASE_TITLE, "UTF-8");

$fullName = $lastName . ' ' . $firstName . ' ' . $middleName;
$fio = mb_substr($lastName, 0, 1) . mb_substr($firstName, 0, 1) . mb_substr($middleName, 0, 1);
$surnameAndInitials = $lastName . ' ' . mb_substr($firstName, 0, 1) . '.' . mb_substr($middleName, 0, 1) . '.';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index.php</title>
</head>
<body>
    <?="<p>Полное имя: '$fullName'</p>";?>
    <?="<p>Фамилия и инициалы: '$surnameAndInitials'</p>";?>
    <?="<p>Аббревиатура: '$fio'</p>";?>
</body>
</html>