<?php
header('Access-Control-Allow-Origin: *');
require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Response::error(array(
        'detail' => 'Метод POST не разрешен'
));
}
$query = $_SERVER['QUERY_STRING'];
if (!$query) {
    Response::error(array(
        'detail' => 'Не переданы параметры аккаунта'
    ));
}

parse_str($query, $query_data);

if (!isset($query_data['user_id']) || !isset($query_data['token'])) {
    $is_login = isset($query_data['user_id']);
    $is_pass = isset($query_data['token']);

    $gen_error = array();

    switch (true) {
        case !$is_login:
            $gen_error['user_id'] = 'Обязательное';
        case !$is_pass:
            $gen_error['token'] = 'Обязательное';
    }
    Response::error($gen_error, 422);
}

$user_id = $_GET['user_id'];

$logs_data = $DB->select('auth','auth_token, login_ts, logout_ts', "user_id = $user_id");

if (!$logs_data) {
    Response::error(array(
        'detail' => 'Такого пользователя не существует'
    ));
}

$logs_data = $logs_data[0];


$is_login_token_true = ($logs_data['auth_token'] == md5($logs_data['login_ts'])) && ($logs_data['auth_token'] == $_GET['token']);
$is_logout_token_true = ($logs_data['auth_token'] == md5($logs_data['logout_ts']));

if ($is_logout_token_true) {
    Response::error(array(
        'detail'=> 'Вы уже вышли из системы'
    ));
}

if(!$is_login_token_true) {
    Response::error(array(
        'detail' => 'Неверный токен'
    ));
} else {
    $time = time();
    $token = md5($time);
    $DB->update('auth',"
        auth_token = '$token',
        login_ts = 0,
        logout_ts = $time
     ", "user_id = $user_id");
    Response::success(array(
        'detail' => 'Вы успешно вышли'
    ));
}

