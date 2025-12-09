<?php
class Stock_Card
{
    //db stuff
    private $conn;
    private $table = 'deppo_stock_card_list';

    //stock properties
    public $id;
    public $code;
    public $name;
    public $quantity;
    public $image_url;
    public $active;

    //constructor with db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //getting stock card from our database
    public function getStockCard()
    {
	//create query
        $query = 'SELECT * FROM ' . $this->table . ' s WHERE s.code = ? LIMIT 1';
	//prepare statement
        $stmt = $this->conn->prepare($query);
        //binding param
	$stmt->bindParam(1, $this->code);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->code = $row['code'];
        $this->name = $row['name'];
        $this->quantity = $row['quantity'];
        $this->image_url = $row['image_url'];
	$this->active = $row['active'];
    }
}
