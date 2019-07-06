<?php

$data = $_POST;
$codeWord = 'qwerty';

if (preg_match('/\W/', $data['login'])) {

    echo 'Поле логин не должно содержать символы @/*?,;:.';

} elseif (!$data['login']) {

    echo 'Поле логин обязательно к заполнению';

} elseif (strlen($data['password']) < 8) {

    echo 'Длина пароля должна быть минимум 8 символов';

} elseif (preg_match('/^\w+@[a-zA-Z]+\.[a-zA-Z]+$/', trim($data['email'])) === 0) {

    echo 'Неверный формат почтового адреса';

} elseif (!$data['firstName'] || !$data['lastName'] || !$data['middleName']) {

    echo 'ФИО обязательно к заполнению';

} elseif ($codeWord !== $data['code']) {

    echo 'Неверно введено кодовое слово';
} else {

    echo 'У вас все хорошо!:)';
};