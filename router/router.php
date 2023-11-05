<?php
require 'init.php';
function router($url) {
    switch ($url[0]) {
        case 'posts':
            ifPosts($url[1]);
            break;
    }
}

function ifPosts($path) {
    switch ($path) {
        case 'general':
            general();
            break;
        case 'all':
            all();
            break;
        default:
            byId($path);
            break;
    }
}
