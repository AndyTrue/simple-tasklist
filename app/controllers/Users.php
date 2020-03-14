<?php


namespace app\controllers;


use app\libraries\Controller;

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err'  => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter the name';
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken';
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            //confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please enter the password';
            } elseif ($data['confirm_password'] != $data['password']) {
                $data['confirm_password_err'] = 'Password do not match';
            }

            //make sure errors are empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated

                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('users/register', $data);
            }

        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
            ];
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [

                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            } elseif (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'No user found';
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            }

            //make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                //validated

                //set user logged in
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login',$data);
                }
            } else {
                //load view with errors
                $this->view('users/login',$data);

            }

        }else {
            //init data
            $data = [

                'email' => '',
                'password' =>'',
            ];

            $this->view('users/login',$data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
}