<?php
  class Supply_Order {
    // DB Stuff
    private $conn;
    private $table = 'supply_order';

    // Properties
    public $SO_Id;
    public $Supplier_name;
    public $Username;
    public $Mat_Id;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Supply_Order
    public function get() {
      // Create query
      $query = 'SELECT s.SO_Id, a.Username, a.Mat_Id, s.Supplier_name 
                FROM ' . $this->table . ' AS s 
                LEFT JOIN admin_material_order AS a ON s.SO_Id = a.SO_Id
                ORDER BY s.SO_Id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Supply_Order
    public function get_single(){
      // Create query
      $query = 'SELECT s.SO_Id, a.Username, a.Mat_Id, s.Supplier_name 
                FROM ' . $this->table . ' AS s 
                LEFT JOIN admin_material_order AS a ON s.SO_Id = a.SO_Id
                WHERE s.SO_Id = ?';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(1, $this->SO_Id);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Post Supply_Order
    public function post() {
      // Create Query
      $query = 'INSERT INTO ' . $this->table . ' SET SO_Id = :SO_Id, Supplier_name = :Supplier_name';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      $this->Supplier_name = htmlspecialchars(strip_tags($this->Supplier_name));
      
      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);
      $stmt-> bindParam(':Supplier_name', $this->Supplier_name);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Put Supply_Order
    public function put() {
      // Create Query
      $query = 'UPDATE ' . $this->table . ' 
                SET Supplier_name = :Supplier_name 
                WHERE SO_Id = :SO_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      $this->Supplier_name = htmlspecialchars(strip_tags($this->Supplier_name));
      
      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);
      $stmt-> bindParam(':Supplier_name', $this->Supplier_name);
      
      // Execute query
      if($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Delete Supply_Order
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' 
                WHERE SO_Id = :SO_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      
      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

  }

