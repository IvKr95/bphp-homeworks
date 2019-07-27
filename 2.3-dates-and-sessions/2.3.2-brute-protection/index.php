<?php

session_start();

$users = [
    'admin' => 'admin1234',
    'randomUser' => 'somePassword',
    'janitor' => 'nimbus2000'
];

if(isset($_POST['submit'])) {

    if (!isset($_SESSION['counter'])) {
        $_SESSION['counter'] = 0;
    };    

    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);

    if(array_key_exists($login, $users) && $users[$login] === $pass) {

        echo 'Добро пожаловать!';
        
    } else {

        $_SESSION['counter'] += 1;

        setcookie('error[' . $_SESSION['counter'] . ']', time(), time()+3600, '/', 'ivkr95.000webhostapp.com');

        if (isset($_COOKIE['error'])) {

            if ((time() - $_COOKIE['error'][$_SESSION['counter'] - 1]) < 5 || (time() - $_COOKIE['error'][$_SESSION['counter'] - 2]) < 60) {

                $dh = fopen($login, 'at');
                $content = date('d.m.Y h:i:s', time());
                fwrite($dh, $content . PHP_EOL);
                fclose($dh);

                exit('Слишком часто вводите пароль. Попробуйте еще раз через минуту.');

            } else {
                echo 'Неверно введены данные';
            };
        } else {
            echo 'Неверно введены данные';
        };
    };
};
 
