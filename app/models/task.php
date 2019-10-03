<?php

class Task extends Model {

    // params: $pagination = items per page; offset = pageNum*Pagination; $orderBy = db.table col name; $order = ASC/DESC;
    public function getList($pagination = 3, $offset = 0, $orderBy = "id", $order = "ASC") {
        $list = [];
        $statement = $this->db->prepare("SELECT * FROM `task` ORDER BY $orderBy $order LIMIT :offset, :pagination");
        $statement->bindValue(':offset', intval($offset), PDO::PARAM_INT);
        $statement->bindValue(':pagination', intval($pagination), PDO::PARAM_INT);
        $statement->execute();
        $list = $statement->fetchAll();
        return $list;
    }

    public function getRowNumber() {
        $rowCount = $this->db->query('SELECT count(*) FROM `task`')->fetchColumn();
        return $rowCount;
    }

    public function getText($id = null) {
        if ($id) {
            $statement = $this->db->prepare('SELECT text FROM `task` WHERE id = :id');
            $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
            $statement->execute();
            $text = $statement->fetch();
            if (isset($text["text"]))
                return $text["text"];
            else
                return false;
        } else {
            return false;
        }
    }

    public function addNewItem($username, $email, $text) {
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $text = htmlspecialchars($text);
        try{
            $this->db->query("INSERT INTO `task` (`username`, `email`, `text`) VALUES (\"$username\", \"$email\", \"$text\")");
        }
        catch(PDOException $exception){
            echo 'Database Error: ' . $exception->getMessage();
        }
    }

    public function editItemText($id, $text) {
        $text = htmlspecialchars($text);
        try{
            $this->db->query("UPDATE `task` SET text = \"$text\", edited=1 WHERE id = $id");
        }
        catch(PDOException $exception){
            echo 'Database Error: ' . $exception->getMessage();
        }
    }

    public function toggleStatus($id) {
        $statement = $this->db->prepare("UPDATE `task` SET status = IF (status, 0, 1) WHERE id = $id");
        $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
        if ($statement->execute())
            return true;
        else
            return false;
    }

}