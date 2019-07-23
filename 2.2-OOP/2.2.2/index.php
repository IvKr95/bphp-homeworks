<?php

include 'autoload.php';
include 'config/SystemConfig.php';

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
    <form action="formActions/addUser.php" method="post" name="create_user">
        <div class="form-group">
            Имя: 
            <input type="text" name="name" placeholder="Имя" required>
        </div>
        <div class="form-group">
            Пароль: 
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            Электронная почта: 
            <input type="email" name="email" placeholder="mymail@mail.ru" required>
        </div>
        <div class="form-group">
            Рейтинг: 
            <input type="number" name="rate" placeholder="100" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Добавить пользователя">
        </div>
    </form>
    <div>
        <?php
            $users = new Users;
            $users->displaySortedList();
        ?>
    </div>
</body>
</html>