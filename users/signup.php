<?php
header('Access-Control-Allow-Origin: *');
require '../init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error(array(
        'detail' => 'Метод GET не разрешен'
    ));
}
$url_get_content = file_get_contents('php://input');

if (strlen($url_get_content) > 0) {
    parse_str($url_get_content,$parsed_body);
} else {
    $parsed_body = array();

    isset($_POST['login']) ? $parsed_body['login'] = $_POST['login'] : 0;
    isset($_POST['pass']) ? $parsed_body['pass'] = $_POST['pass'] : 0;
}


if (!isset($parsed_body['login']) || !isset($parsed_body['pass'])) {
    $is_login = isset($parsed_body['login']);
    $is_pass = isset($parsed_body['pass']);

    $gen_error = array();

    switch (true) {
        case !$is_login:
            $gen_error['login'] = 'Обязательное';
        case !$is_pass:
            $gen_error['pass'] = 'Обязательное';
    }
    Response::error($gen_error, 422);
}


$login = $_POST['login'];
$pass = password_hash($_POST['pass'],PASSWORD_BCRYPT);


$is_login_exist = $DB->select('users', 'id',"login = '$login'");

if (count($is_login_exist)) {
    Response::error(array(
        'login' => 'Пользователь с таким логином уже существует'
    ));
}

if(strlen($_POST['pass']) < 5) {
    Response::error(array(
        'pass' => 'Пароль должен быть более 5-ти символов'
    ));
}

$result = $DB->insert('users','login,pass',[$login,$pass]);
$time = time();
$token = md5($time);
if ($result) {
    $user_data = $DB->select('users','id',"login = '$login'")[0];
    try {
        $DB->insert('auth', 'user_id,auth_token,login_ts,logout_ts', [$user_data['id'], $token, $time, 0]);
    } catch (Exception $e) {
        var_dump($e);
    }
    Response::success(array(
        'detail' => 'Вы успешно зарегистрировались',
        'data' => array(
            'user_id' => (int) $user_data['id'],
            'auth_token' => $token
        )
    ));

} else {
    Response::error(array(
        'detail' => 'Неизвестная ошибка'
    ));
}
