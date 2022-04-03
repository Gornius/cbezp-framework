<?php

include_once 'mvc/models/User.php';
include_once 'classes/Dependencies.php';

class UserController {
    public function register() {
        include_once 'mvc/views/User/UserRegister.php';
        $view = new UserRegister;
        $view->display();
    }

    public function save_register() {
        $user = new User;
        $record = [];
        foreach($user->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }
        $user->save($record);
        echo 'Registered successfully!';
    }
}