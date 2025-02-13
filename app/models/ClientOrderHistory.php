<?php

require_once __DIR__ .  "/../../core/db/Database.php";

class ClientOrderHistory {
    public $client_id;
    public $client_name;
    public $client_email;
    public $description;
    public $last_order_date;
    public $last_order_value;

    private $conn;

    public function __construct($client_id, $client_name, $client_email, $description, $last_order_date, $last_order_value) {
        $this->client_id = $client_id;
        $this->client_name = $client_name;
        $this->client_email = $client_email;
        $this->description = $description;
        $this->last_order_date = $last_order_date;
        $this->last_order_value = $last_order_value;

        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createClientOrderHistory(){

        $query = "INSERT INTO client_order_history (client_id, 
                                            client_name, 
                                            client_email, 
                                            description, 
                                            last_order_date, 
                                            last_order_value)
                        VALUES ($this->client_id, 
                                '$this->client_name', 
                                '$this->client_email', 
                                '$this->description', 
                                '$this->last_order_date', 
                                '$this->last_order_value')";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public static function updateClientOrderHistory($conn, $order_id, $client_id, $client_name, $client_email, $description, $last_order_date, $last_order_value){
        $query = "UPDATE loja_magica_db.client_order_history
                    SET client_id = $client_id, 
                        client_name = '$client_name', 
                        client_email = '$client_email', 
                        description = '$description', 
                        last_order_date = '$last_order_date', 
                        last_order_value = $last_order_value
                    WHERE id = $order_id;";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function getSpecificClientOrderHistory($conn, $client_order_id){
        $query = "SELECT id,
                        client_id, 
                        client_name, 
                        client_email, 
                        description, 
                        last_order_date, 
                        last_order_value
                    FROM loja_magica_db.client_order_history
                    WHERE id = $client_order_id;";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $client_order_data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $client_order_data ? $client_order_data : null;
    }

    public static function getAllClientOrderHistory($conn){
        $query = "SELECT id,
                        client_id, 
                        client_name, 
                        client_email, 
                        description, 
                        last_order_date, 
                        last_order_value
                    FROM loja_magica_db.client_order_history;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $client_order_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return !empty($client_order_data) ? $client_order_data : null;
    }

    public static function deleteClientOrderHistory($conn, $client_order_id){
        $query = "DELETE FROM loja_magica_db.client_order_history
                            WHERE id = $client_order_id;";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function getAllClientEmails($conn){
        $query = "SELECT client_email
                    FROM loja_magica_db.client_order_history;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $client_order_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return !empty($client_order_data) ? $client_order_data : null;
    }
}

?>
