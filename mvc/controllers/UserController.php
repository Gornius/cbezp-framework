<?php

include_once 'mvc/models/User.php';
include_once 'classes/Dependencies.php';

class UserController {
    public function view_register() {
        include_once 'mvc/views/User/UserRegister.php';
        $view = new UserRegister;
        $view->display();
    }

    public function register() {
        $user = new User;
        $record = [];
        foreach($user->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }
        $user->save($record);
        echo 'Registered successfully!';
    }

    public function view_login(){ 
        include_once 'mvc/views/User/UserLogin.php';
        $view = new UserLogin;
        $view->display();
    }

    public function login() {
        $user = new User;
        $record = [];
        foreach($user->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }
        $user_in_db = $user->find_record("name = '".$record['name']."'");

        if(password_verify($record['password'], $user_in_db['password'])) {
            $_SESSION['user'] = $record['name'];
        }

        else {
            echo 'Nieprawidlowe dane';
        }
    }

    public function logout() {
        unset($_SESSION['user']);
    }
}