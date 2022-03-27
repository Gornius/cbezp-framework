<?php

include_once 'mvc/models/Post.php';

class PostController {
    public function list() {
        include_once 'mvc/views/Post/PostList.php';
        $post = new Post;

        $posts = $post->get_list('deleted = 0');
        $view = new PostList;
        $view->display($posts);
    }

    public function edit() {
        $record_id = $_GET['id'];
        if (!empty($record_id)){
            $post = new Post;
            $record = $post->get_record($record_id);

            if (!empty($record)) {
                include_once 'mvc/views/Post/PostEdit.php';
                $view = new PostEdit;
                $view->display($record);
            }
            else {
                echo "<br>Record couldn't be loaded!";
            }

        }
        else {
            include_once 'mvc/views/Post/PostEdit.php';
            $view = new PostEdit;
            $view->display(NULL); 
        }
    }

    public function reset_db() {
        $post = new Post;
        $post->reset_db();
        echo 'Table "' . $post->table_name . '" has been reset.';
    }

    public function save() {
        $post = new Post;
        $record = [];
        foreach ($post->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }
        $record['id'] = $_POST['id'];
        $post->save($record);
    }
}