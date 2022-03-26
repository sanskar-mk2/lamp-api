<?php
/*
CREATE TABLE `users` (
 `userid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(60) NOT NULL DEFAULT '',
 `useremail` varchar(100) NOT NULL DEFAULT '',
 `userstatus` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
*/

class Database
{
    protected $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to the db");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function select($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    private function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);

            if ($stmt == false) {
                throw new Exception("unable to do prepared stmt: " . $query);
            }

            if ($params) {
                $stmt->bind_param($params[0], $params[1]);
            }

            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
