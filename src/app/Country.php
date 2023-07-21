<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;

class Country extends Database
{
    private $table_name = "tb_country_codes";
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
        return  $this->data = toObject($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    public function whereIn(array $ids)
    {
        $ids = join("','",$ids);
        $query = "SELECT * FROM {$this->table_name} WHERE id IN (:ids)";  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':ids',$ids);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}