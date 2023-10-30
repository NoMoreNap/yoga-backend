<?php

const HTTP_BAD_REQUEST = 400;
const HTTP_OK = 200;

class Response {
    static function error($fields = ['detail' => 'false'], $code = HTTP_BAD_REQUEST) {
        Response::create_json($fields,false,$code);
    }

    static function success($fields = ['detail' => 'ok'], $code = HTTP_OK) {
        Response::create_json($fields,true,$code);
    }
    static private function create_json($fields, $status, $code) {
        $status = array('status' => $status);
        $result = array_merge($status,$fields);
        http_response_code($code);
        exit(json_encode($result));
    }
}
