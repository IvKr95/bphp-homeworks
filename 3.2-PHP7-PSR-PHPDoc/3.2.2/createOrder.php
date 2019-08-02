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
require_once 'classes/CreateBill.php';
$menu = loadJSON('menu');
$order = $_POST;
$bill = new CreateBill($menu, $order);

renderView('default', 'order', [ 'order' => $bill->getBill()]);