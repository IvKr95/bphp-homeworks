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
require_once 'calcBill.php';
$menu = loadJSON('menu');
$order = $_POST;
$billObj = new Bill($menu, $order);

renderView('default', 'order', [ 'order' => $billObj->getBill()]);