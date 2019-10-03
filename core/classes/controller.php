<?php

class Controller {

    public $view;
    public $model;
    public $request;

    function __construct() {

        $this->view = new View();

        $params = [];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $item) {
                $params[$key] = $item;
            }
        } elseif (!empty($_GET)) {
            foreach ($_GET as $key => $item) {
                $params[$key] = $item;
            }
        }
        $this->request = $params;
    }

    function setModel($modelName) {

        $path = ROOT . '/app/models/' . $modelName . '.php';
        $path = strtolower($path);

        if (file_exists($path)) {
            require($path);
            $this->model = new $modelName();
        }
    }

    function checkPermission() {
        if (!isset($_SESSION['login'])) {
            header('Location: /authorization/');
            die();
        }
    }
}