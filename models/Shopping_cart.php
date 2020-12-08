<?php
  class Shopping_cart{
      // DB connections
      private $conn;
      private $table = 'shopping_cart';

      public $Customer_Id;
      public $Total_cost;
      public $Art_Id;
      public $Art_name;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT S.Customer_Id, S.Total_cost
                  FROM ' . $this->table . ' AS S 
                  ORDER BY S.Customer_Id';
        
        //C.Art_Id, I.Art_name
        //LEFT JOIN shopping_cart_contains AS C ON S.Customer_Id = C.Customer_Id
        //LEFT JOIN art_item AS I ON C.Art_Id = I.Art_Id

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        // Create query
        $query = 'SELECT S.Customer_Id, S.Total_cost 
                  FROM ' . $this->table . ' AS S 
                  WHERE S.Customer_Id = ?';

        //C.Art_Id, I.Art_name
        //LEFT JOIN shopping_cart_contains AS C ON S.Customer_Id = C.Customer_Id
        //LEFT JOIN art_item AS I ON C.Art_Id = I.Art_Id
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Customer_Id);

        $stmt->execute();

        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Customer_Id = :Customer_Id,
            Total_cost = :Total_cost';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Total_cost = htmlspecialchars(strip_tags($this->Total_cost));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Total_cost', $this->Total_cost);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET Total_cost = :Total_cost
        WHERE Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Total_cost = htmlspecialchars(strip_tags($this->Total_cost));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Total_cost', $this->Total_cost);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        // bind data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
 ?>
