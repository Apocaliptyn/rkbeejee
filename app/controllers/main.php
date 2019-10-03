<?php

class MainController extends Controller {

    function defaultAction() {
        $this->view->render('template/header');
        $this->view->render('template/menu');
        require_once(ROOT . "/app/controllers/task.php");
        $task = new TaskController();
        $task->setModel("Task");
        $task->getListAction();
        $this->view->render('template/footer');
    }

}
