<?php
class DBConection
{
    public $servarname = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "business_site";

    public $conn;

    public function conaction()
    {
        $this->conn = new mysqli($this->servarname, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}


?>