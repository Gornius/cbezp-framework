<?php

class RolePermissionsList {
    public function display($role_id) {
        $role = new Role();
        $permission = new Permission();

        $all_permissions = $permission->get_list();
        $list = $role->get_permissions_list($role_id);
        $available_list = array_diff_assoc($all_permissions, $list);

        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('permissions', $list);
        $ss->assign('available_list', $available_list);
        $ss->assign('role_id', $role_id);
        $ss->display('mvc/views/Role/tpl/role_permissions_list.tpl');
    }
}
