<?php
require_once('Page.php');
//nova instanca Home od klasata Page.php
$page = new Page('Home');
$page->description('Home Page');
$page->keywords('home, website');
$page->robots(true);
echo $page->display('Nova instanca od klasata Page.php');
?>
