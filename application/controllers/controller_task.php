<?php

class Controller_Task extends Controller
{

    function __construct()
    {
        $this->model = new Model_Task();
        $this->view = new View([
            'property' => $this->model->property,
            'label' => $this->model->label
        ]);
    }

    

    public function action_index()
    {
        $model = new Model_Task();
        $page = empty($_GET['page']) ? 1 : $_GET['page'];

        $pagin = $model->pagination($page);
        $data = $model->getAllTasks($page);
        $content = 'tasks';
        $template = 'layout';
        $this->view->generate($content, $template, ['pagin' => $pagin, 'data' => $data]);
    }

    public function action_delete_task()
    {
        $id = filter_input(INPUT_POST, 'id');
        if (empty($id)) {
            return false;
        } else {
            if ($this->model->delete_task($id)) {
                $model = new Model_Task();
                $data = $model->getAllTasks();
                $pagin = $model->pagination($page);
                ob_start();
                $this->view->generate('tasks', false, ['data' => $data, 'pagin' => $pagin]);
                $result = ob_get_clean();
                echo $result;
            }
        }
        exit();
    }

    public function action_create_task()
    {
        $dataPost = $_POST['new_task'];

        if (!empty($dataPost)) {
            $imageUrl = $this->model->uploadImage();
            $dataPost['photo'] = isset($imageUrl) ? $imageUrl : '';
            $newId = $this->model->create_task($dataPost);
            if (empty($newId)) {
                echo 'no new';
            } else {
                $newModel = $this->model->getTask($newId);
                unset($_POST['new_task']);
                header("Location: http://mvc/task/view_task?id=" . $newId);
                exit;
            }
        }

        $this->view->generate('create_task', 'layout', ['data' => $data]);
    }

    public function action_view_task()
    {
        $id = filter_input(INPUT_GET, 'id');
        $model = $this->model->getTask($id);
        if (!empty($model)) {
            return $this->view->generate('view_task', 'layout', ['model' => $model]);
        }
        return $this->view->generate('task', 'layout', [
                'data' => $model->getAllTasks($page),
                'pagin' => $model->pagination($page)
        ]);
    }

}