<?php

class Controller {
    /**
     * Checks if logged user has certain permission
     *
     * @param mixed $permission - name of the permission
     * 
     * @return true - if user has permission
     * @return false - if user doesn't have permission
     * 
     */
    public function check_access($permission) {
        $user_model = new User();
        $user = $_SESSION['user'];

        if (empty($user)) return false;

        $permissions = $user_model->get_permission_names($user['id']);

        if(in_array($permission, $permissions)) {
            return true;
        }
        return false;
    }

    public function check_super_admin() {
        $user = $_SESSION['user'];
        if (!$user['super_admin']) {
            return false;
        }
        return true;
    }
}