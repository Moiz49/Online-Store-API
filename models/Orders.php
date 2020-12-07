<?php
  class Orders{
      // DB connections
      private $conn;
      private $table = 'orders';

      public $Customer_Id;
      public $Order_Id;
      public $Final_cost;
      public $Art_Id;


      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT S.Order_Id, S.Customer_Id, A.Art_Id, S.Final_cost
                  FROM ' . $this->table . ' as S LEFT JOIN order_contains A ON
                  S.Order_Id = A.Order_Id';
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        // Create query
        $query = 'SELECT S.Order_Id, S.Customer_Id, A.Art_Id, S.Final_cost
                  FROM ' . $this->table . ' as S LEFT JOIN order_contains A ON
                  S.Order_Id = A.Order_Id
                  WHERE S.Order_Id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Order_Id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Customer_Id = $row['Customer_Id'];
        $this->Order_Id = $row['Order_Id'];
        $this->Art_Id = $row['Art_Id'];
        $this->Final_cost = $row['Final_cost'];
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Order_Id = :Order_Id,
            Customer_Id = :Customer_Id,
            Final_cost = :Final_cost';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        //$this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Final_cost = htmlspecialchars(strip_tags($this->Final_cost));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        //$stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Final_cost', $this->Final_cost);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){

        $query = 'UPDATE' .$this->table . '
        SET Customer_Id = :Customer_Id,
            Final_cost = :Final_cost
        WHERE Order_Id = :Order_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        //$this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Final_cost = htmlspecialchars(strip_tags($this->Final_cost));

        //bind the data
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        //$stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Final_cost', $this->Final_cost);

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
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
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
