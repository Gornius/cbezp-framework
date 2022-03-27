<?php

include_once 'classes/Dependencies.php';

class PostList {
    public function display($list) {
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('posts', $list);
        $ss->display('mvc/views/Post/tpl/list.tpl');
    }
}