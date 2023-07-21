<?php
namespace Kadex\app;
use PDO;
use PDOException;
abstract class Database 
{    
    /**
     * conn
     *
     * @var ?PDO
     */
    public $conn;   
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $table_name; 
    public function __construct()
    {
        $this->host = HOST;
        $this->db_name = "kadex_db";
        $this->username = "root";
        $this->password = "";
        $this->conn = $this->getConnection();
    }
    
    /**
     * getConnection
     * Connecting with database
     * @return ?PDO
     */
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
       
    /**
     * getId
     * Get the data with Id 
     * @param  mixed $id
     * @return object
     */
    abstract public function getId(int $id) :?object;    
    /**
     * getCount
     * Get the count with condition
     * @param  mixed $condition
     * @return int
     */
    abstract public function getCount(String $condition = ""):int;    
    /**
     * all
     * get all data
     * 
     */
    abstract public function all();
}