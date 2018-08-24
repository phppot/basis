<?php
session_start();
use \PhpPot\Controller\Dispatcher;
require_once "./Controller/Dispatcher.php";
$dispatcher = new Dispatcher();
$dispatcher->dispatch();
