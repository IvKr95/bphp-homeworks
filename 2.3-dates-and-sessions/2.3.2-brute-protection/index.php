<?php

session_start();

$users = [
    'admin' => 'admin1234',
    'randomUser' => 'somePassword',
    'janitor' => 'nimbus2000'
];

$badLoginLimit = 3;
$btwTwoLimit = 5;
$btwThreeLimit = 60;

if(isset($_POST['submit'])) {

    $_SESSION['counter'] ?? $_SESSION['counter'] = 1;

    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);

    if(array_key_exists($login, $users) && $users[$login] === $pass) {

        echo 'Добро пожаловать!';
        
    } else {

        setcookie('error[' . $_SESSION['counter'] . ']', time(), time()+3600, '/', 'ivkr95.000webhostapp.com');
        
        if (isset($_COOKIE['error'])) {
            
            if ($_SESSION['counter'] >= $badLoginLimit && (time() - $_COOKIE['error'][$_SESSION['counter'] - 2]) < $btwThreeLimit
                || (time() - $_COOKIE['error'][$_SESSION['counter'] - 1]) < $btwTwoLimit) {

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
    $_SESSION['counter'] += 1;
};
 
