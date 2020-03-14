<?php


namespace app\controllers;


use app\libraries\Controller;

class Pages extends Controller
{
    public function index()
    {
        $this->view('pages/index');
    }

    public function about()
    {
        $this->view('pages/about');
    }
}