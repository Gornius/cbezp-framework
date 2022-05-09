<?php

class PostEdit {
    public function display($record) {
        global $loaded_user;
        $user = new User();

        if (isset($record['id']) && $loaded_user['id'] != $record['user_id'] && !$user->check_access($loaded_user['id'], 'edit_any_post')) {
            die('You don\'t have permission to edit this post!');
        }

        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Post edit');
        $ss->assign('record', $record);
        $ss->display('mvc/views/Post/tpl/edit.tpl');
    }
}