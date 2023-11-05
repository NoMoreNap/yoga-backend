<?php
function byId($id) {
    require '../init.php';
    $data = array('data'=>$POSTS->getById($id));
    if ($data['data']) {
        Response::success($data);
    } else {
        Response::error(array(
            'detail'=>'Указан неверный id'
        ));
    }
}
