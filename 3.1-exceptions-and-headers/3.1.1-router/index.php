<?php

/**
 * Доступные страницы на сайте
 *
 * @var array $availableLinks
 */
require './autoload.php';
$availableLinks = include './availableLinks.php';

$params = $_GET;
$param = 'page';
$pageName = $_GET[$param] ?? null;

function isParam($param, $params) 
{
    if(!array_key_exists($param, $params)) {
        throw new BadRequest('The GET parameters are not present');
    };
};

try {
    isParam($param, $params);

    $router = new Router($availableLinks);

    try {
        $router->isAvailablePage($pageName);
    } catch (NotFound $e) {
        header('Location: ./NotFound.php', true, 404);
    };
    
} catch(BadRequest $e) {
    header('Location: ./BadRequest.php', true, 400);
};
