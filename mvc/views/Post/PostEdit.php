<?php

include_once 'classes/Dependencies.php';

class PostEdit {
    public function display($record) {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Post edit');
        $ss->assign('record', $record);
        $ss->display('mvc/views/Post/tpl/edit.tpl');
    }
}