<?php

include '../autoload.php';
include '../config/SystemConfig.php';

$newUser = new User;
$formData = $_POST;

$newUser->addUserFromForm($formData);
$newUser->commit();

header('HTTP/1.1 200 OK'); 
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/2.2-OOP/2.2.2');