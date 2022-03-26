<?php
require_once PROJECTROOT . "/model/db.php";

class Usermodel extends Database {
    public function getUsers($limit) {
        return $this->select("SELECT * FROM users ORDER BY userid ASC LIMIT ?", ["i", $limit]);
    }
}