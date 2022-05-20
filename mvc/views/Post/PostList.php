<?php

class PostList {
    public function globalEditable() {
        global $loaded_user;
        $user = new User();
        return $user->check_access($loaded_user['id'], 'edit_any_post');
    }

    public function globalDeletable() {
        global $loaded_user;
        $user = new User();
        return $user->check_access($loaded_user['id'], 'remove_any_post');
    }

    public function display($list, $only_own=false) {
        global $loaded_user;
        foreach($list as $key => &$element) {
            global $loaded_user;
            $user = new User();
            $show_only_own_posts = $only_own;

            // Remove elements that are not owned by user
            if($show_only_own_posts && $element['user_id'] != $loaded_user['id']) {
                unset($list[$key]);
            }

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
        $ss->assign('user', $loaded_user);
        $ss->assign('global_editable', $this->globalEditable());
        $ss->assign('global_deletable', $this->globalDeletable());
        $ss->display('mvc/views/Post/tpl/list.tpl');
    }
}