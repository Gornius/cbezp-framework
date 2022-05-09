<?php

class UserController extends Controller{
    public function view_register() {
        $view = new UserRegister;
        $view->display();
    }

    public function register() {
        $user = new User;
        $record = [];
        foreach($user->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }

        // Ensure database gets checkbox value value
        // TODO?: Might implement that later in db

        if (empty($record['uses_2step'])) $record['uses_2step'] = '0';
        
        // Ensure super_admin can't be created thorugh register
        $record['super_admin'] = 0;

        $user_in_db = $user->find_record("name = '".$record['name']."'");
        if(!empty($user_in_db)) {
            echo 'Użytkownik już istnieje!<br>';
            $this->view_register();
        }
        else {
            $user->save($record);
            echo 'Registered successfully!';
            header('Location: /');
        }
    }

    public function view_login(){ 
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
            if ($user_in_db['uses_2step'] == '1') {
                $_SESSION['validation_code'] = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);
                $_SESSION['user_to_validate'] = $user_in_db;
                $mailer = new PHPMailerHelper();
                $mailer->sendMail([$user_in_db['email']], 'Second step verification for account '.$user_in_db['name'].'!', 'Your verification code is: '.$_SESSION['validation_code']);

                $this->view_login_2nd_step($record);
            }
            else {
                $_SESSION['user'] = $user_in_db['id'];
                header('Location: /');
            }
        }

        else {
            echo 'Nieprawidlowe dane<br>';
            $this->view_login();
        }
    }

    public function view_login_2nd_step() {
        $usermodel = new User;

        $view = new User2ndStep;
        $view->display();
    }

    public function login_2nd_step() {
        $code = $_POST['code'];
        if ($code != $_SESSION['validation_code']) {
            echo '<div class="alert alert-danger">Wrong code has been provided! Try again!</div>';
            $this->view_login_2nd_step();
        }
        else {
            $_SESSION['user'] = $_SESSION['user_to_validate'];
            unset($_SESSION['user_to_validate']);
            unset($_SESSION['validation_code']);
            echo 'Logged in!';
            header('Location: /');
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: /');
    }
}