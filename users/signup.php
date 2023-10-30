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
    isset($_POST['email']) ? $parsed_body['email'] = $_POST['email'] : 0;

}


if (!isset($parsed_body['login']) || !isset($parsed_body['pass']) || !isset($parsed_body['email'])) {
    $is_login = isset($parsed_body['login']);
    $is_pass = isset($parsed_body['pass']);
    $is_email = isset($parsed_body['email']);

    $gen_error = array();

    switch (true) {
        case !$is_login:
            $gen_error['login'] = 'Обязательное';
        case !$is_pass:
            $gen_error['pass'] = 'Обязательное';
        case !$is_email:
            $gen_error['email'] = 'Обязательное';
    }
    Response::error($gen_error, 422);
}


$login = $_POST['login'];
$email = $_POST['email'];
$pass = password_hash($_POST['pass'],PASSWORD_BCRYPT);



$is_email_exist = $DB->select('users', 'id',"email = '$email'");
$is_login_exist = $DB->select('users', 'id',"login = '$login'");

if (count($is_login_exist)) {
    Response::error(array(
        'login' => 'Пользователь с таким логином уже существует'
    ));
}
if (strpos($email, '@') === false) {
    Response::error(array(
        'email' => 'Укажите корректную почту'
    ));
}
if (count($is_email_exist)) {
    Response::error(array(
        'email' => 'Пользователь с такой почтой уже существует'
    ));
}

if(strlen($_POST['pass']) < 5) {
    Response::error(array(
        'pass' => 'Пароль должен быть более 5-ти символов'
    ));
}

$result = $DB->insert('users','login,pass,email',[$login,$pass,$email]);

if ($result) {
    Response::success(array(
        'detail' => 'Вы успешно зарегистрировались'
    ));
} else {
    Response::error(array(
        'detail' => 'Неизвестная ошибка'
    ));
}
