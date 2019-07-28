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
$router = new Router($availableLinks);

function isParam($param, $params) 
{
    return array_key_exists($param, $params);
};

function openPage($params = [], $param = '', $router) 
{
    $pageName = $_GET[$param] ?? null;

    if (!isParam($param, $params)) {
        throw new BadRequest('The GET parameters are not present');
    };

    if (!$router->isAvailablePage($pageName)) {
        throw new NotFound('Page Not Found');
    } else {
        echo "Вы находитесь на странице <b>$pageName</b>";
    }
};

try {
    openPage($params, $param, $router);
} catch(BadRequest $e) {
    header('Location: ./BadRequest.php', true, 400);
} catch(NotFound $e) {
    header('Location: ./NotFound.php', true, 404);
};
