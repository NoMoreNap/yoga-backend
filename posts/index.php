<?php
require '../router/router_construct.php'; // class
require '../router/router.php'; // func
$URL = $_SERVER['REQUEST_URI'];

$handler = new Router($URL);

router($handler->getPath());

