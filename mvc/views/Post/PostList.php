<?php

class PostList {
    public function display($list) {
        foreach($list as &$element) {
            $user = new User();
            $user = $user->get_record($element['user_id']);

            if (!empty($user)) {
                $element['user_name'] = $user['name'];
            }
            else {
                $element['user_name'] = "anonymouse";
            }
        }
        $ss = Dependencies::get_smarty();
        $ss->assign('title', 'Posts list');
        $ss->assign('posts', $list);
        $ss->display('mvc/views/Post/tpl/list.tpl');
    }
}