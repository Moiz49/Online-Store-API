<?php
  class Order_contains{
      // DB connections
      private $conn;
      private $table = 'order_contains';

      public $Order_Id;
      public $Art_Id;
      public $Art_qty;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT O.Order_Id, O.Art_Id, I.Art_name, O.Art_qty
                  FROM ' . $this->table . ' AS O 
                  LEFT JOIN art_item AS I ON O.Art_Id = I.Art_Id
                  ORDER BY O.Order_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        // Create query
        $query = 'SELECT O.Order_Id, O.Art_Id, I.Art_name, O.Art_qty
                  FROM ' . $this->table . ' AS O 
                  LEFT JOIN art_item AS I ON O.Art_Id = I.Art_Id
                  WHERE Order_Id = :Order_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Order_Id', $this->Order_Id);

        $stmt->execute();

        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Order_Id = :Order_Id,
            Art_Id = :Art_Id,
            Art_qty = :Art_qty';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Art_qty = htmlspecialchars(strip_tags($this->Art_qty));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Art_qty', $this->Art_qty);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET Art_qty = :Art_qty
        WHERE Order_Id = :Order_Id AND Art_Id =  :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Art_qty = htmlspecialchars(strip_tags($this->Art_qty));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Art_qty', $this->Art_qty);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' 
                  WHERE Order_Id = :Order_Id AND Art_Id = :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));

        // bind data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
 ?>
