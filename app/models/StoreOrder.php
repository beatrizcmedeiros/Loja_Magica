<?php

require_once __DIR__ .  "/../../core/db/Database.php";

class StoreOrder {
    public $store_id;
    public $store_name;
    public $store_location;
    public $product_description;
    public $amount;

    private $conn;

    public function __construct($store_id, $store_name, $store_location, $product_description, $amount) {
        $this->store_id = $store_id;
        $this->store_name = $store_name;
        $this->store_location = $store_location;
        $this->product_description = $product_description;
        $this->amount = $amount;

        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createStoreOrder(){
        $query = "INSERT INTO loja_magica_db.store_order (store_id, 
                                                            store_name, 
                                                            store_location, 
                                                            product_description, 
                                                            amount)
                            VALUES('$this->store_id', 
                                    '$this->store_name', 
                                    '$this->store_location',
                                    '$this->product_description', 
                                    $this->amount);";

        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute();
    }

}

?>
