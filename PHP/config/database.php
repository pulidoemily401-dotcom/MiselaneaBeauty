<?php

class Database
{
    private $host = "localhost";
    private $db_name = "miselaneabeauty";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() : PDO
    {

        $this->conn = null;
        try{
         $this->conn = new PDO(dsn: "mysql:host=" . $this->host . ";dbname=" . $this->db_name, username: $this->username, password:
        $this->password);
        $this->conn->exec(statement: "set names utf8");
        

        }catch (PDOException $exception){
            echo "Error de conexion: " . $exception->getMessage();


        }
        return $this->conn;

      

    }
}