<?php

class TaskController extends Controller {

    function defaultAction() {
        // header("Location: /");
        // die();
    }

    function getListAction() {

        if (!empty($this->request["orderby"])) {
            $orderBy = $this->request["orderby"];
        } else {
            $orderBy = "id";
        }
        if (!empty($this->request["order"])) {
            $order = $this->request["order"];
        } else {
            $order = "ASC";
        }
        if (!empty($this->request["page"])) {
            $page = $this->request["page"];
        } else {
            $page = 0;
        }
        $paginationPerPage = 3;
        $offset = $page * $paginationPerPage;

        $list = $this->model->getList($paginationPerPage, $offset, $orderBy, $order);
        $itemCount = $this->model->getRowNumber();
        $username = (isset($_SESSION["login"])) ? $_SESSION["login"] : false;
        $this->view->render('task/table', ["list" => $list, "request" => $this->request, "item_per_page" => $paginationPerPage, "item_count" => $itemCount, "username" => $username]);
    }

    function createAction() {
        $errors = [];

        $formSent = false;
        if ((isset($this->request["username"])) OR
            (isset($this->request["email"])) OR
            (isset($this->request["text"]))) {
            $formSent = true;
            if ((!empty($this->request["username"])) AND
                (!empty($this->request["email"])) AND
                (!empty($this->request["text"]))) {
                if (filter_var($this->request["email"], FILTER_VALIDATE_EMAIL) === false) {
                    $errors[] = "E-Mail не соответствует стандартам.";
                }
            } else {
                $errors[] = "Все поля обязательны для заполнения";
            }
        }


        if (($formSent) AND (empty($errors))) {
            $this->model->addNewItem($this->request["username"], $this->request["email"], $this->request["text"]);

            header("Location: /");
            die();
        }


        $this->view->render('template/header');
        $this->view->render('template/menu');
        $this->view->render('task/create', ["errors" => $errors, "form_fields" => $this->request]);
        $this->view->render('template/footer');
    }

    function editAction() {
        $this->checkPermission();

        $errors = [];

        if (empty($this->request["id"])) {
            header("Location: /");
            die();
        }

        $formSent = false;
        if ((isset($this->request["text"]))) {
            $formSent = true;
            $formFields = $this->request;
            if (!empty($this->request["text"])) {

            } else {
                $errors[] = "Текст не может быть пустым.";
            }
        } else {
            $formFields = [
                "id" => $this->request["id"],
                "text" => $this->model->getText($this->request["id"])
            ];
        }


        if (($formSent) AND (empty($errors))) {
            $this->model->editItemText($this->request["id"], $this->request["text"]);

            header("Location: /");
            die();
        }

        $this->view->render('template/header');
        $this->view->render('template/menu');
        $this->view->render('task/edit', ["errors" => $errors, "form_fields" => $formFields]);
        $this->view->render('template/footer');
    }

    function toggleItemStatusAction() {
        $this->checkPermission();

        if (empty($this->request["id"])) {
            return false;
        }

        if ($this->model->toggleStatus($this->request["id"])) echo "1"; else echo "2";
    }
}
