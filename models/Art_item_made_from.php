<?php
  class Art_item_made_from{
      // DB connections
      private $conn;
      private $table = 'art_item_made_from';

      public $Art_Id;
      public $Mat_Id;
      public $M_qty_each_item;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get Shopping_cart
      public function Get(){
        // Create query
        $query = 'SELECT F.Art_Id, F.Mat_Id, M.Mat_name, F.M_qty_each_item
                  FROM ' . $this->table . ' AS F 
                  LEFT JOIN material AS M ON F.Mat_Id = M.Mat_Id
                  ORDER BY F.Art_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single shopping cart
      public function Get_single(){
        // Create query
        $query = 'SELECT F.Art_Id, F.Mat_Id, M.Mat_name, F.M_qty_each_item
                  FROM ' . $this->table . ' AS F 
                  LEFT JOIN material AS M ON F.Mat_Id = M.Mat_Id
                  WHERE F.Art_Id = :Art_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Art_Id', $this->Art_Id);

        $stmt->execute();

        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Mat_Id = :Mat_Id,
            Art_Id = :Art_Id,
            M_qty_each_item = :M_qty_each_item';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->M_qty_each_item = htmlspecialchars(strip_tags($this->M_qty_each_item));

        //bind the data
        $stmt->bindParam(':Mat_Id', $this->Mat_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':M_qty_each_item', $this->M_qty_each_item);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . '
        SET M_qty_each_item = :M_qty_each_item
        WHERE Mat_Id = :Mat_Id AND Art_Id =  :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->M_qty_each_item = htmlspecialchars(strip_tags($this->M_qty_each_item));

        //bind the data
        $stmt->bindParam(':Mat_Id', $this->Mat_Id);
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':M_qty_each_item', $this->M_qty_each_item);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' 
                  WHERE Mat_Id = :Mat_Id AND Art_Id = :Art_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));

        // bind data
        $stmt->bindParam(':Mat_Id', $this->Mat_Id);
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
