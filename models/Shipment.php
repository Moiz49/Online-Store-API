<?php
  class Shipment{
      // DB connections
      private $conn;
      private $table = 'shipment';

      public $Order_Id;
      public $Status_;
      public $Scompany;
      public $Ship_date;
      public $Destination;


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
                  WHERE S.Order_Id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Order_Id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Order_Id = $row['Order_Id'];
        $this->Status_ = $row['Status_'];
        $this->Scompany = $row['Scompany'];
        $this->Ship_date = $row['Ship_date'];
        $this->Destination = $row['Destination'];

      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Order_Id = :Order_Id,
            Status_ = :Status_,
            Scompany = :Scompany,
            Ship_date = :Ship_date,
            Destination = :Destination';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Status_ = htmlspecialchars(strip_tags($this->Status_));
        $this->Scompany = htmlspecialchars(strip_tags($this->Scompany));
        $this->Ship_date = htmlspecialchars(strip_tags($this->Ship_date));
        $this->Destination = htmlspecialchars(strip_tags($this->Destination));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Status_', $this->Status_);
        $stmt->bindParam(':Scompany', $this->Scompany);
        $stmt->bindParam(':Ship_date', $this->Ship_date);
        $stmt->bindParam(':Destination', $this->Destination);


        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){

        $query = 'UPDATE ' .$this->table . '
        SET Status_ = :Status_,
            Scompany = :Scompany,
            Ship_date = :Ship_date,
            Destination = :Destination,
        WHERE Order_Id = :Order_Id';


        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Order_Id = htmlspecialchars(strip_tags($this->Order_Id));
        $this->Status_ = htmlspecialchars(strip_tags($this->Status_));
        $this->Scompany = htmlspecialchars(strip_tags($this->Scompany));
        $this->Ship_date = htmlspecialchars(strip_tags($this->Ship_date));
        $this->Destination = htmlspecialchars(strip_tags($this->Destination));

        //bind the data
        $stmt->bindParam(':Order_Id', $this->Order_Id);
        $stmt->bindParam(':Status_', $this->Status_);
        $stmt->bindParam(':Scompany', $this->Scompany);
        $stmt->bindParam(':Ship_date', $this->Ship_date);
        $stmt->bindParam(':Destination', $this->Destination);

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
