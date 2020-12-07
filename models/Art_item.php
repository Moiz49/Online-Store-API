<?php
  class Art_item{
      // DB connections
      private $conn;
      private $table = 'art_item';

      public $Art_Id;
      public $Art_name;
      public $Quantity;
      public $Price;
      public $Type_;


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
                  FROM ' . $this->table . ' as S
                  WHERE S.Art_Id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Art_Id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Art_Id = $row['Art_Id'];
        $this->Art_name = $row['Art_name'];
        $this->Quantity = $row['Quantity'];
        $this->Price = $row['Price'];
        $this->Type_ = $row['Type_'];

      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Art_Id = :Art_Id,
            Art_name = :Art_name,
            Quantity = :Quantity,
            Price = :Price,
            Type_ = :Type_';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Art_name = htmlspecialchars(strip_tags($this->Art_name));
        $this->Art_name = htmlspecialchars(strip_tags($this->Art_name));
        $this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
        $this->Price = htmlspecialchars(strip_tags($this->Price));
        $this->Type_ = htmlspecialchars(strip_tags($this->Type_));

        //bind the data
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Art_name', $this->Art_name);
        $stmt->bindParam(':Quantity', $this->Quantity);
        $stmt->bindParam(':Price', $this->Price);
        $stmt->bindParam(':Type_', $this->Type_);


        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET Art_name = :Art_name,
            Quantity = :Quantity,
            Price = :Price,
            Type_ = :Type_
        WHERE Art_Id = :Art_Id';


        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Art_name = htmlspecialchars(strip_tags($this->Art_name));
        $this->Art_name = htmlspecialchars(strip_tags($this->Art_name));
        $this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
        $this->Price = htmlspecialchars(strip_tags($this->Price));
        $this->Type_ = htmlspecialchars(strip_tags($this->Type_));

        //bind the data
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Art_name', $this->Art_name);
        $stmt->bindParam(':Quantity', $this->Quantity);
        $stmt->bindParam(':Price', $this->Price);
        $stmt->bindParam(':Type_', $this->Type_);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE Art_Id = :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        // bind data
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
