<?php
require '../init.php';

$DB->query('START TRANSACTION;');
$DB->query('drop table posts;');
$DB->query('drop table users;');
$DB->query('drop table auth;');


$DB->query('commit;');
