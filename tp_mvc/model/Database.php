<?php

abstract class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tp_mvc";
    protected $conn;

    public function __construct()
    {   
        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>