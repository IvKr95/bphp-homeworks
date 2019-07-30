<?php

require './Person.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bPHP - 3.2.1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        $name = 'Иван';
        $surname = 'Иванов';
        $patronymic = 'Иванович';
        $new_person = new Person($name, $surname, $patronymic);
    ?>
  <h2>
    <span class="gender-<?= $new_person->getGender() ?>">
      <?= $new_person->getGenderSymbol() ?>
    </span> 
    <?= $new_person->getFio() ?>
  </h2>
</body>
</html>

