<?php


namespace app\libraries;

/**
 * App core class
 *
 */
class Core
{
    protected $currentController = 'Pages';
    private $currentMethod = 'index';
    private $params = [];

    public function __construct()
    {

        $url = $this->getUrl();
        //look in controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]). '.php')) {
            $this->currentController = ucwords($url[0]);

            unset($url[0]);
        }


        $controller = 'app\controllers\\' . $this->currentController;
        //instantiate controller class
        $this->currentController = new $controller;

        //check for second part of url
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }

        //get params
        $this->params = $url ? array_values($url) : [];

        //call methods with params in controller
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}