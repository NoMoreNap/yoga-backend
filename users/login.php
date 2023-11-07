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
$pass = $_POST['pass'];

$user_data = $DB->select('users', 'id, pass',"login = '$login'");
if (!$user_data) {
    Response::error(array(
        'detail' => 'Такого пользователя не существует'
    ));
}
$is_pass_true = password_verify($pass, $user_data[0]['pass']);

if (!$is_pass_true) {
    Response::error(array(
        'detail' => 'Неверный пароль'
    ));
} else {
    $time = time();
    $token = md5($time);
    $user_id = $user_data[0]['id'];

    $auth_data = $DB->select('auth','auth_token,login_ts')[0];

    $is_login_already = md5($auth_data['login_ts']) == $auth_data['auth_token'];

    if ($is_login_already) {
        Response::error(array(
            'detail' => 'Вы уже вошли в систему'
        ));
    }

    $DB->update('auth', "auth_token = '$token', login_ts = $time, logout_ts = 0", "user_id = $user_id");
    Response::success(array(
        'detail' => 'Вы вошли в систему',
        'data' => array(
            'user_id' => (int) $user_id,
            'auth_token' => $token
        )
    ));

}





