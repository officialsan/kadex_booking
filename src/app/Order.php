<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;

class Order extends Database
{
    private $table_name = "tb_order_details";
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
                            user_id,
                            shipping_id,
                            order_no,
                            cart,
                            date_booked,
                            instructions,
                            price,
                            discount,
                            vat,
                            final_price,
                            order_status,
                            created_at,
                            completed
                        ) VALUES (
                            :user_id,
                            :shipping_id,
                            :order_no,
                            :cart,
                            :date_booked,
                            :instructions,
                            :price,
                            :discount,
                            :vat,
                            :final_price,
                            :order_status,
                            :created_at,
                            :completed
                        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':user_id', $this->data['user_id']);
        $stmt->bindValue(':shipping_id', $this->data['shipping_id']);
        $stmt->bindValue(':order_no', $this->data['order_no']);
        $stmt->bindValue(':cart', $this->data['cart']);
        $stmt->bindValue(':date_booked', $this->data['date_booked']);
        $stmt->bindValue(':instructions', $this->data['instructions']);
        $stmt->bindValue(':price', $this->data['price']);
        $stmt->bindValue(':discount', $this->data['discount']);
        $stmt->bindValue(':vat', $this->data['vat']);
        $stmt->bindValue(':final_price', $this->data['final_price']);
        $stmt->bindValue(':order_status', $this->data['order_status']);
        $stmt->bindValue(':created_at', $this->data['created_at']);
        $stmt->bindValue(':completed', $this->data['completed']);  
              
        return $stmt->execute() ? true : false;
    }
}