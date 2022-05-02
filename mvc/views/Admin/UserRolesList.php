<?php

class UserRolesList {
    public function display($user_id) {
        $user = new User();
        $role = new Role();

        $all_roles = $role->get_list();
        $list = $user->get_role_list($user_id);
        $available_list = array_diff_assoc($all_roles, $list);

        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('roles', $list);
        $ss->assign('available_list', $available_list);
        $ss->assign('user_id', $user_id);
        $ss->display('mvc/views/Admin/tpl/user_roles_list.tpl');
    }
}
