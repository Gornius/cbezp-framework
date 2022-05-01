<?php

class UserRegister {
    public function display() {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Register');
        $ss->display('mvc/views/User/tpl/register.tpl');
    }
}
