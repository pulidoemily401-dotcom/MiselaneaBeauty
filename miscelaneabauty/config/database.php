<?php
class Database
{
    private $host     = "localhost";
    private $db_name  = "u243468983_miselanea";
    private $username = "u243468983_miselanea";
    private $password = "42018400Miselanea";
    public  $conn;

    public function getConnection(): PDO
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            error_log("Error de conexión: " . $exception->getMessage());
            header('Content-Type: application/json');
            die(json_encode(['ok' => false, 'msg' => 'Error de conexión a la base de datos']));
            exit;
        }
        return $this->conn;
    }
}