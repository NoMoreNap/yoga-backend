<?php
require_once 'lib/mysql.php';
require_once 'lib/response.php';
require_once 'lib/posts.php';

$DB = new MySQL('localhost','root', '123', 'yoga');
$POSTS = new Posts('localhost','root', '123', 'yoga');

//function p($message) {
//    echo '<pre>';
//    var_dump($message);
//    echo '</pre>';
//}

