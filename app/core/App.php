<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // controllers handle admin url
        if (isset($url[0]) && $url[0] == 'admin') {
            if (isset($url[1]) && file_exists('../app/controllers/admin/' . ucfirst($url[1]) . '.php')) {
                $this->controller = ucfirst($url[1]);
                unset($url[0]);
                unset($url[1]);
            } else {
                $this->controller = 'Dashboard';
            }

            require_once '../app/controllers/admin/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            // method
            if (isset($url[2])) {
                if (method_exists($this->controller, $url[2])) {
                    $this->method = $url[2];
                    unset($url[2]);
                }
            }

            // params
            if (!empty($url)) {
                $this->params = array_values($url);
            }


            // cek argument
            $argumentsMethodCheck = new ReflectionMethod($this->controller, $this->method);
            if (count($argumentsMethodCheck->getParameters()) > 0 && empty($this->params)) {
                http_response_code(400);
                echo "Bad Request: Invalid argument";
                die();
            }

            // jalankan controller & method, serta kirimkan params jika ada
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {

            // controller normally
            if ((isset($url[0]))) {
                if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                    $this->controller = ucfirst($url[0]);
                    unset($url[0]);
                }
            }
            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            // method
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            // params
            if (!empty($url)) {
                $this->params = array_values($url);
            }


            // cek argument
            $argumentsMethodCheck = new ReflectionMethod($this->controller, $this->method);
            if (count($argumentsMethodCheck->getParameters()) > 0 && empty($this->params)) {
                http_response_code(400);
                echo "Bad Request: Invalid argument";
                die();
            }

            // jalankan controller & method, serta kirimkan params jika ada
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
