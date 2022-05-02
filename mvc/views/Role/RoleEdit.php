<?php

class RoleEdit {
    public function display($record) {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Post edit');
        $ss->assign('record', $record);
        $ss->display('mvc/views/Role/tpl/edit.tpl');
    }
}