<?php

include_once 'mvc/models/Post.php';

class PostController {
    public function list() {
        include_once 'mvc/views/Post/PostList.php';
        $post = new Post;

        $posts = $post->get_list();
        $view = new PostList;
        $view->display($posts);
    }

    public function edit() {
        $record_id = $_GET['id'];
        if (!empty($record_id)){
            $post = new Post;
            $record = $post->get_record('1');

            if (!empty($record)) {
                include_once 'mvc/views/Post/PostEdit.php';
                $view = new PostEdit;
                $view->display($record);
            }
            else {
                echo "Record couldn't be loaded!";
            }

        }
        else {
            echo("No record id specified!");
        }
    }

    public function reset_db() {
        $post = new Post;
        $post->reset_db();
        echo 'Table "' . $post->table_name . '" has been reset.';
    }
}