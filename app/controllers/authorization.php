<?php

class AuthorizationController extends Controller {


    public function defaultAction($request = null) {
        $errors = [];
        $formSent = false;
        if ((isset($this->request["username"])) OR (isset($this->request["password"]))) {
            $formSent = true;
            if ((!empty($this->request["username"])) AND (!empty($this->request["password"]))) {
                if (($this->request["username"] == "admin") AND ($this->request["password"] == "123")) {

                } else {
                    $errors[] = "Не правильное имя пользователя или пароль";
                }
            } else {
                $errors[] = "Все поля обязательны для заполнения";
            }
        }


        if (($formSent) AND (empty($errors))) {
                $_SESSION['login'] = "admin";
                header("Location: /");
                die();
        }

        $this->view->render('template/header');
        $this->view->render('authorization/form', ["errors" => $errors, "form_fields" => $this->request]);
        $this->view->render('template/footer');
    }

    public function logoutAction($request = null) {
        $_SESSION = [];
        session_unset();
        header('Location: /');
    }
}