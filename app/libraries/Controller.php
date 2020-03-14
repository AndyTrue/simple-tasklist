<?php


namespace app\libraries;


class Controller
{
    //load model
    public function model($model)
    {
        $model = 'app\models\\' . $model;
        //instantiate model
        return new $model();
    }

    //load view
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View  does not exists');
        }
    }
}
