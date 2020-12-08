<?php
  class shopping_cart_contains{
      // DB connections
      private $conn;
      private $table = 'shopping_cart_contains';

      public $Customer_Id;
      public $Art_Id;
      public $Art_qty;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT C.Customer_Id, C.Art_Id, I.Art_name, C.Art_qty
                  FROM ' . $this->table . ' AS C 
                  LEFT JOIN art_item AS I ON C.Art_Id = I.Art_Id
                  ORDER BY C.Customer_Id';

        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        $query = 'SELECT C.Customer_Id, C.Art_Id, I.Art_name, C.Art_qty
                  FROM ' . $this->table . ' AS C 
                  LEFT JOIN art_item AS I ON C.Art_Id = I.Art_Id
                  WHERE Customer_Id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Customer_Id);


        $stmt->execute();
        
        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
                  SET Customer_Id = :Customer_Id, Art_Id = :Art_Id, Art_qty = :Art_qty';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Art_qty = htmlspecialchars(strip_tags($this->Art_qty));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
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
        WHERE Customer_Id = :Customer_Id AND Art_Id =  :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Art_qty = htmlspecialchars(strip_tags($this->Art_qty));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
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
                  WHERE Customer_Id = :Customer_Id  AND Art_Id =  :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        // bind data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
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
