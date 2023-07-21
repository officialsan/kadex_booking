<?php
namespace Kadex\app;

use PDO;
use Kadex\app\Database;
use Kadex\app\Auth;
class Cart extends Database
{
    private $table_name = "tb_cart";
    public $data;
    public $cart;

    public function __construct()
    {
        $this->cart =  $_SESSION['cart'] ??  ['items'=>[]] ;
    }    
    
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
        return toObject($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    public function whereIn(array $ids)
    {
        $ids = join("','",$ids);
        $query = "SELECT * FROM {$this->table_name} WHERE id IN ('$ids')"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    /**
     * addCart
     *  
     * @param  mixed $item 
     *  item params must be like   
     *   [ 
     *      'product_id' => $product_id,
     *      'product_name' => $product->product,
     *      'quantity' => $quantity,
     *      'unit_price' => $product->price,
     *      'total_price' =>  $product->price * $quantity,
     *    ]
     * 
     */
    public function addCart($item)
    {
        
        if($this->checkItemExist($item['product_id'])) return errorResponse('Item already exist in cart');
        $this->cart['items'][] = $item;
        $this->updateCart();
        $cartDiv = render('cart');
        return successResponse('Item successFully added to cart','success',$cartDiv);
    }
    private function updateCart()
    {
        $this->cart['subTotal'] = $this->calcSubtotal();
        $_SESSION['cart'] = $this->cart;
    }
    private function calcSubtotal()
    {
        return array_sum(array_column($this->cart['items'],'total_price'));
    }
    private function checkItemExist($product_id)
    {
        return (array_search($product_id, array_column($this->cart['items'], 'product_id')) !== FALSE) ;
    }
    public function distroyCart()
    {
        $this->cart = [];
        unset($_SESSION['cart']);
    }
    public function  removeItem($product_id)
    {
        $key = array_search($product_id , array_column($this->cart['items'], 'product_id'));
        array_splice($this->cart['items'], $key,1);
        $this->updateCart();
        $cartDiv = render('cart');
        return successResponse('Item successFully removed from cart','success',$cartDiv);
    }
    public function getCart()
    {
        return $this->cart;
    }
    public function updateDateAndTime($date, $time){
        $this->cart['date'] =  $date;
        $this->cart['time'] =  $time;
        $this->updateCart();
        return successResponse('Cart successFully updated','success');
    }
    public function upload()
    {
        foreach ($this->cart['items'] as $item) {
            $product = new Product();
            $product = $product->getId( $item['product_id']);
            $data = [ 
                'user_id' => Auth::getUserId(),
                'product_id' => $item['product_id'],
                'price' => $product->price,
                'status' => 1,       
            ];
            $cart_ids[] = $this->save($data);
        }
        return  $cart_ids;
    }
    private function save(array $data): ?int
    {
        $query = "INSERT INTO  {$this->table_name} (user_id,product_id,price,status,created_at) VALUES (:user_id,:product_id,:price,:status,:created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':user_id',$data['user_id']);
        $stmt->bindValue(':product_id',$data['product_id']);
        $stmt->bindValue(':price',$data['price']);
        $stmt->bindValue(':status',$data['status']);
        $stmt->bindValue(':created_at',date("Y-m-d H:i:s"));
        return $stmt->execute() ? $this->conn->lastInsertId() : null ;
    }
    public function getDateAndTime()
    {
        return date('Y-m-d H:i:s',strtotime ($this->cart['date']." ".$this->cart['time']));
    }

}