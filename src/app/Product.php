<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;

class Product extends Database
{
    private $table_name = "tb_products";
    public $data;
    public function getId(int $id)  :?object
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE id = :id LIMIT 1" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':id',$id);
        if($stmt->execute()) return  $this->data = toObject($stmt->fetch(PDO::FETCH_ASSOC));
        return $this->data ;
    }

    public function getCount(String $condition = ""):int
    {
        $query = "SELECT count(*) as allcount  FROM {$this->table_name} ORDER BY id DESC";  
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['allcount'];
        }
        return 0;
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table_name} ";  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return  $this->data =  toObject($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    
    public function getProductsWithServiceId(int $service_id, bool $taskGroup = false)
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE service_id = :id " ;
        $query .= $taskGroup ? "GROUP BY  tasks ORDER BY price ASC" : "ORDER BY duration";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':id',$service_id);
        if($stmt->execute()) return  $this->data = ($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->data;

    }
    public function getRelatedProductsWithServiceId(int $service_id, string $task)
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE service_id = :id AND tasks = :task ORDER BY duration" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':id',$service_id);
        $stmt->bindValue(':task',$task);
        if($stmt->execute()) return  $this->data = ($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->data;
    }
    
}