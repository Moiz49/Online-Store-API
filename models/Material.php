<?php
  class Material {
    // DB Stuff
    private $conn;
    private $table = 'material';

    // Properties
    public $Mat_Id;
    public $Mat_name;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Materials
    public function get() {
      // Create query
      $query = 'SELECT Mat_Id, Mat_name FROM ' . $this->table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Material
    public function get_single(){
      // Create query
      $query = 'SELECT Mat_Id, Mat_name FROM ' . $this->table . ' WHERE Mat_Id = ? LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->Mat_Id);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Post Material
    public function post() {
      // Create Query
      $query = 'INSERT INTO ' . $this->table . ' SET Mat_Id = :Mat_Id, Mat_name = :Mat_name';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
      $this->Mat_name = htmlspecialchars(strip_tags($this->Mat_name));
      
      // Bind data
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);
      $stmt-> bindParam(':Mat_name', $this->Mat_name);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Put Material
    public function put() {
      // Create Query
      $query = 'UPDATE ' . $this->table . ' SET Mat_name = :Mat_name WHERE Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));
      $this->Mat_name = htmlspecialchars(strip_tags($this->Mat_name));
      
      // Bind data
      $stmt-> bindParam(':Mat_Id', $this->Mat_Id);
      $stmt-> bindParam(':Mat_name', $this->Mat_name);
      
      // Execute query
      if($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Delete Material
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE Mat_Id = :Mat_Id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // clean data
      $this->Mat_Id = htmlspecialchars(strip_tags($this->Mat_Id));

      // Bind Data
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
