<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;

class User extends Database
{
    private $table_name = "tb_user_list";
    public $data;
    public function getId(int $id) :?object
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE id = :id LIMIT 1" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':id',$id);
        if($stmt->execute() && $data = $stmt->fetch(PDO::FETCH_ASSOC)) return  $this->data = toObject($data);
        return $this->data;
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
    public function getByemail(string $email):?object
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE email = :email LIMIT 1" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':email',$email);
        if($stmt->execute() && $data = $stmt->fetch(PDO::FETCH_ASSOC) ) return $this->data = toObject($data);
        return $this->data;
    }
    public function save(): bool
    {
        if(!$this->data) return false;
        $query = "INSERT INTO  {$this->table_name} (fname,lname,phone,email,city,landmark,address,country,active) VALUES (:fname,:lname,:phone,:email,:city,:landmark,:address,:country,:active)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':fname',$this->data['fname']);
        $stmt->bindValue(':lname',$this->data['lname']);
        $stmt->bindValue(':phone',$this->data['phone']);
        $stmt->bindValue(':email',$this->data['email']);
        $stmt->bindValue(':city',$this->data['city']);
        $stmt->bindValue(':landmark',$this->data['landmark']);
        $stmt->bindValue(':address',$this->data['address']);
        $stmt->bindValue(':country',$this->data['country']);
        $stmt->bindValue(':password',md5($this->data['password']));
        $stmt->bindValue(':active',1);
        return $stmt->execute() ? true : false;
    }
    



}