<?php

include_once 'classes/Dependencies.php';
include_once 'mvc/models/User.php';

class UsersList {
    public function display($opts = []) {
        $user_model = new User();
        $list = $user_model->get_list();
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('users', $list);
        $ss->display('mvc/views/Admin/tpl/users_list.tpl');
    }
}
