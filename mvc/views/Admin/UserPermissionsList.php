<?php

class UserPermissionsList {
    public function display($user_id) {
        $user = new User();

        $permission = new Permission();

        $all_permissions = $permission->get_list();
        $list = $user->get_permissions_list($user_id);
        $available_list = array_diff_assoc($all_permissions, $list);

        // var_dump($list);
        // var_dump($all_permissions);

        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('permissions', $list);
        $ss->assign('available_list', $available_list);
        $ss->assign('user_id', $user_id);
        $ss->display('mvc/views/Admin/tpl/user_permissions_list.tpl');
    }
}
