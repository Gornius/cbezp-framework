<?php

class RoleList {
    public function display() {
        $role = new Role();
        $roles_list = $role->get_list();

        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('roles', $roles_list);
        $ss->display('mvc/views/Role/tpl/role_list.tpl');
    }
}
