<?php
namespace Kadex\app;
use PDO;
class Database 
{
    public $conn;   
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct()
    {
        $this->host = HOST;
        $this->db_name = "kadex_db";
        $this->username = "root";
        $this->password = "";
        $this->conn = $this->getConnection();
    }

    public function getConnection()
    {
        $conn = null;
        try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn;
    }

}