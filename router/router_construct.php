<?php
require '../init.php';

class Router
{
    public function __construct($path) {
        $this->path = explode('/',$path);
    }

    public function getPath() {
        return [$this->path[1],$this->path[2]];
    }
}
