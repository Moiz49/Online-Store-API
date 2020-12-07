<?php
  class shopping_cart_contains{
      // DB connections
      private $conn;
      private $table = 'shopping_cart_contains';

      public $Customer_Id;
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
                  WHERE Customer_Id = ? AND Art_Id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Customer_Id);
        $stmt->bindParam(2, $this->Art_Id);


        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Customer_Id = $row['Customer_Id'];
        $this->$Art_Id = $row['Art_Id'];
        $this->$Amount = $row['Amount'];

      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Customer_Id = :Customer_Id,
            Art_Id = :Art_Id,
            Amount = :Amount';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
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
        WHERE Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
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
