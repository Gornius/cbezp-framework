<?php

include_once 'classes/Dependencies.php';
include_once 'mvc/models/Post.php';

class PostController {
    public function list() {
        include_once 'mvc/views/Post/list.php';
        $post = new Post;

        $posts = $post->get_list();
        $view = new PostList;
        $view->display($posts);
    }

    public function reset_db() {
        $post = new Post;
        $post->reset_db();
        echo 'Table "' . $post->table_name . '" has been reset.';
    }
}