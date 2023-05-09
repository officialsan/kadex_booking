<?php
namespace Kadex\app;
use PDO;
abstract class Database 
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

    private  function getConnection()
    {
        $conn = null;
        try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn;
    }
    private $table_name;
    abstract public function getId(int $id) :?object;
    abstract public function getCount(String $condition = ""):int;
    abstract public function all();
}