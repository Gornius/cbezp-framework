
<?php

include_once 'classes/Dependencies.php';

class UserLogin {
    public function display() {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Login');
        $ss->display('mvc/views/User/tpl/login.tpl');
    }
}
