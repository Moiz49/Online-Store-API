<?php
  class Admin_Material_Order {
    // DB Stuff
    private $conn;
    private $table = 'admin_material_order';

    // Properties
    public $SO_Id;
    public $Username;
    public $Mat_Id;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Admin_Material_Order
    public function get() {
      // Create query
      $query = 'SELECT SO_Id, Username, Mat_Id 
                FROM ' . $this->table . ' 
                ORDER BY SO_Id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Admin_Material_Order
    public function get_single(){
      // Create query
      $query = 'SELECT SO_Id, Username, Mat_Id 
                FROM ' . $this->table . '
                WHERE SO_Id = ?';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(1, $this->SO_Id);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Post Admin_Material_Order
    public function post() {
      // Create Query
      $query = 'INSERT INTO ' . $this->table . ' 
                SET SO_Id = :SO_Id, Username = :Username, Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));

      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Put Admin_Material_Order
    public function put() {
      // Create Query
      $query = 'UPDATE ' . $this->table . ' 
                SET Mat_Id = :Mat_Id 
                WHERE SO_Id = :SO_Id AND Username = :Username';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));

      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);
      
      // Execute query
      if($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Delete Admin_Material_Order
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' 
                WHERE SO_Id = :SO_Id AND Username = :Username AND Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->SO_Id = htmlspecialchars(strip_tags($this->SO_Id));
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));

      // Bind data
      $stmt-> bindParam(':SO_Id', $this->SO_Id);
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

  }

