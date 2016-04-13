<?php
$root = $_SERVER['DOCUMENT_ROOT']."/MIXR/";
require $root."include/pages.php";
require $root."libs/service.php";
require $root."libs/config.php";
require $root."libs/functions.php";
require $root."handlers/LoginHandler.php";
require $root."handlers/UserHandler.php";
require $root."handlers/ErrorHandler.php";
require $root."handlers/MusicHandler.php";

session_start();
$config = new config();
$service = new Service();
$loginHandler = new LoginHandler($service);
$userHandler = new UserHandler($service);
$musicHandler = new MusicHandler($service);
?>