
<?php

include_once 'classes/Dependencies.php';

class User2ndStep {
    public function display() {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', '2nd step verification');
        $ss->display('mvc/views/User/tpl/2ndStep.tpl');
    }
}
