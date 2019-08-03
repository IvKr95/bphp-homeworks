<?php

session_start();

$users = [
    'admin' => 'admin1234',
    'randomUser' => 'somePassword',
    'janitor' => 'nimbus2000'
];

$_SESSION['firstSubmitTime'] ?? $_SESSION['firstSubmitTime'] = 0;
$_SESSION['lastSubmitTime'] ?? $_SESSION['lastSubmitTime'] = 0;
$_SESSION['counter'] ?? $_SESSION['counter'] = 0;


if(isset($_POST['submit'])) {

    if ($_SESSION['counter'] === 0) $_SESSION['firstSubmitTime'] = time();
    if ($_SESSION['counter'] === 3) $_SESSION['counter'] = 0;

    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);

    if(array_key_exists($login, $users) && $users[$login] === $pass) {

        echo 'Добро пожаловать!';
        
    } else {
        $_SESSION['counter'] += 1;

        setcookie('error[' . $_SESSION['counter'] . ']', time(), time()+3600, '/', 'ivkr95.000webhostapp.com');

        echo 'Неверно введены данные';

        if (isset($_COOKIE['error'])) {

            if (time() - $_SESSION['lastSubmitTime'] < 5 || $_SESSION['counter'] === 3 && time() - $_SESSION['firstSubmitTime'] < 60) {
                $dh = fopen($login, 'ab');
                $content = date('d.m.Y h:i:s', time());
                fwrite($dh, $content . PHP_EOL);
                fclose($dh);
                
                $_SESSION['lastSubmitTime'] = time();
                exit('Слишком часто вводите пароль. Попробуйте еще раз через минуту');
            };
        };
    };

    $_SESSION['lastSubmitTime'] = time();
};
 
