<?php

class APIHelper {
    private const disallowed_models = [
        'User',
    ];

    public static function json_safe_encode($obj) {
        if (empty($obj)) $obj = [];
        return json_encode($obj);
    }

    public static function handle_model_request(string $model_name, string $action, $id="", $where="", $data="") {
        if (empty($model_name)) return false;
        if (in_array($model_name, self::disallowed_models)) return false;
        $model = new $model_name;

        if ($action == 'list') {
            $response = $model->get_list($where);
            return self::json_safe_encode($response);
        }
        if ($action == 'get') {
            $response = $model->get_record($id);
            return self::json_safe_encode($response);
        }
    }
}