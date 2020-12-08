<?php
  class Customer{
      // DB connections
      private $conn;
      private $table = 'customer';

      public $Customer_Id;
      public $Name_;
      public $Email_address;
      public $Address;


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
        $query = 'SELECT Customer_Id, Name_, Email_address, Address
                  FROM ' . $this->table . ' 
                  WHERE Customer_Id = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Customer_Id);

        $stmt->execute();

        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Customer_Id = :Customer_Id,
            Name_ = :Name_,
            Email_address = :Email_address,
            Address = :Address';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Name_ = htmlspecialchars(strip_tags($this->Name_));
        $this->Email_address = htmlspecialchars(strip_tags($this->Email_address));
        $this->Address = htmlspecialchars(strip_tags($this->Address));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Name_', $this->Name_);
        $stmt->bindParam(':Email_address', $this->Email_address);
        $stmt->bindParam(':Address', $this->Address);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET Name_ =  :Name_,
            Email_address = :Email_address,
            Address = :Address
        WHERE Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Name_ = htmlspecialchars(strip_tags($this->Name_));
        $this->Email_address = htmlspecialchars(strip_tags($this->Email_address));
        $this->Address = htmlspecialchars(strip_tags($this->Address));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Name_', $this->Name_);
        $stmt->bindParam(':Email_address', $this->Email_address);
        $stmt->bindParam(':Address', $this->Address);

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
