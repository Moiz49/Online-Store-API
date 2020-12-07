<?php
  class Manage_Inventory {
    // DB Stuff
    private $conn;
    private $table = 'manage_inventory';

    // Properties
    public $Username;
    public $Mat_Id;
    public $Mat_name;
    public $M_qty;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Manage_Inventory
    public function get() {
      // Create query
      $query = 'SELECT i.Username, i.Mat_Id, m.Mat_name, i.M_qty 
                FROM ' . $this->table . ' AS i 
                LEFT JOIN material AS m ON i.Mat_Id= m.Mat_Id
                ORDER BY i.Username';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Inventory
    public function get_single(){
      // Create query
      $query = 'SELECT i.Username, i.Mat_Id, m.Mat_name, i.M_qty 
                FROM ' . $this->table . ' AS i 
                LEFT JOIN material AS m ON i.Mat_Id= m.Mat_Id
                WHERE i.Username = ?';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(1, $this->Username);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Post Manage_Inventory
    public function post() {
      // Create Query
      $query = 'INSERT INTO ' . $this->table . ' SET Username = :Username,
                Mat_Id = :Mat_Id, M_qty = :M_qty';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
      $this->M_qty = htmlspecialchars(strip_tags($this->M_qty));
      
      // Bind data
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);
      $stmt-> bindParam(':M_qty', $this->M_qty);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Put Manage_Inventory
    public function put() {
      // Create Query
      $query = 'UPDATE ' . $this->table . ' 
                SET M_qty = :M_qty 
                WHERE Username = :Username AND Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
      $this->M_qty = htmlspecialchars(strip_tags($this->M_qty));
      
      // Bind data
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);
      $stmt-> bindParam(':M_qty', $this->M_qty);
      
      // Execute query
      if($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Delete Manage_Inventory
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' 
                WHERE Username = :Username AND Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
      
      // Bind data
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
