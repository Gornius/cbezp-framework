<?php

class Controller {
    public function check_access($permission) {
    }

    public function check_super_admin() {
        $user = $_SESSION['user'];
        if (!$user['super_admin']) {
            return false;
        }
        return true;
    }
}