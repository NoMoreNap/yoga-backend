<?php
function all() {
    require '../init.php';
    $data = array('data'=>$POSTS->getAllData());
    Response::success($data);
}
