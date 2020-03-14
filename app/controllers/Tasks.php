<?php


namespace app\controllers;


use app\libraries\Controller;

class Tasks extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->taskModel = $this->model('Task');

    }

    public function index()
    {

        $tasks = $this->taskModel->getTasks();

        $data = [
            'tasks' => $tasks
        ];
        $this->view('tasks/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            //validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            //validate body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            //make sure errors are empty
            if (empty($data['title_err']) && empty($data['body_err']) ) {

                if ($this->taskModel->addTask($data)) {
                    redirect('tasks');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('tasks/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
            ];
            $this->view('tasks/add', $data);
        }
    }

    public function show($id)
    {
        $task = $this->taskModel->getTaskById($id);
        $data = [
            'task' => $task,
        ];
        $this->view('tasks/show',$data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            //validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            //validate body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            //make sure errors are empty
            if (empty($data['title_err']) && empty($data['body_err']) ) {

                if ($this->taskModel->updateTask($data)) {
                    redirect('tasks');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('tasks/edit', $data);
            }
        } else {
            //get existing post from model
            $task = $this->taskModel->getTaskById($id);

            $data = [
                'id' => $id,
                'title' => $task->title,
                'body' => $task->body,
            ];
            $this->view('tasks/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->taskModel->deleteTask($id)) {
                redirect('tasks');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('tasks');
        }

    }


}