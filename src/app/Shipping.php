<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;

class Shipping extends Database
{
    private $table_name = "tb_shipping_details";
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
    public function whereIn(array $ids)
    {
        $ids = join("','",$ids);
        $query = "SELECT * FROM {$this->table_name} WHERE id IN (:ids)";  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':ids',$ids);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save()
    {
        if(!$this->data) return false;
        $query = "INSERT INTO  
                        {$this->table_name} 
                        ( 
                            fname,
                            lname,
                            phone,
                            phone_code,
                            email,
                            city,
                            landmark,
                            address,
                            country,
                            created_at
                        ) VALUES (
                            :fname,
                            :lname,
                            :phone,
                            :phone_code,
                            :email,
                            :city,
                            :landmark,
                            :address,
                            :country,
                            :created_at
                        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':fname',$this->data['fname']);
        $stmt->bindValue(':lname',$this->data['lname']);
        $stmt->bindValue(':phone',$this->data['phone']);
        $stmt->bindValue(':phone_code',$this->data['phone_code']);
        $stmt->bindValue(':email',$this->data['email']);
        $stmt->bindValue(':city',$this->data['city']);
        $stmt->bindValue(':landmark',$this->data['landmark']);
        $stmt->bindValue(':address',$this->data['address']);
        $stmt->bindValue(':country',$this->data['country']);
        $stmt->bindValue(':created_at',date('Y-m-d H:i:s'));
        if($stmt->execute()){
            return $this->data['id'] = $this->conn->lastInsertId();
        }
        return false;
    }
}