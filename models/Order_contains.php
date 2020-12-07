<?php
  class Order_contains{
      // DB connections
      private $conn;
      private $table = 'order_contains';

      public $Order_Id;
      public $Art_Id;
      public $Amount;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT *
                  FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        // Create query
        $query = 'SELECT *
                  FROM ' . $this->table . '
                  WHERE Order_Id = :Order_Id AND Art_Id = :Art_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Order_Id = $row['Order_Id'];
        $this->$Art_Id = $row['Art_Id'];
        $this->$Amount = $row['Amount'];

      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Order_Id = :Order_Id,
            Art_Id = :Art_Id,
            Amount = :Amount';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Amount', $this->Amount);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET Art_Id =  :Art_Id,
            Amount = :Amount
        WHERE Order_Id = :Order_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Amount', $this->Amount);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE Order_Id = :Order_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        // bind data
        $stmt->bindParam(':Order_Id', $this->Order_Id);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
 ?>
