<?php
class Database {
    private $host = 'localhost';
    private $db   = 'GlamBook'; // ✅ match the exact name in phpMyAdmin
    private $user = 'root';
    private $pass = ''; // leave empty if no password
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
