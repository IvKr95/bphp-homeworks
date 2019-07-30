<?php
/**
 * frontfile of order create
 *
 * @var array $menu
 * @var array $post
 */

require_once 'const.php';
require_once 'loadJSON.php';
require_once 'renderView.php';
require_once 'calcTheBill.php';
$menu = loadJSON('menu');
$post = $_POST;

renderView('default','order', [ 'order' => calcTheBill($menu, $post)]);