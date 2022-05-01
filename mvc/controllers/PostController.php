<?php

class PostController {
    public function list() {
        $post = new Post;

        $posts = $post->get_list('deleted = 0 and type="public"');
        $view = new PostList;
        $view->display($posts);
    }

    public function edit() {
        $record_id = $_GET['id'];
        if (!empty($record_id)){
            $post = new Post;
            $record = $post->get_record($record_id);

            if (!empty($record)) {
                $view = new PostEdit;
                $view->display($record);
            }
            else {
                echo "<br>Record couldn't be loaded!";
            }

        }
        else {
            $view = new PostEdit;
            $view->display(NULL); 
        }
    }

    public function save() {
        $post = new Post;
        $record = [];
        foreach ($post->fields as $field => $params) {
            $record[$field] = $_POST[$field];
            if ($field == 'name') $record[$field] = UserInputFilterService::filter_user_input($record[$field], UserInputFilterService::NAME_FILTER);
            if ($field == 'message') $record[$field] = UserInputFilterService::filter_user_input($record[$field], UserInputFilterService::NAME_FILTER);
        }
        $record['id'] = $_POST['id'];
        $post->save($record);
        header('Location: /index.php?model=Post');
    }

    public function delete() {
        $id = $_GET['id'];
        $post = new Post;
        $record = $post->delete($id);
        header('Location: /index.php?model=Post');
    }
}