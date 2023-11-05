<?php
function general() {
    require '../init.php';
    $data = array('data'=>$POSTS->getGeneralData());
    Response::success($data);
}
