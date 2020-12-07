<?php
  class Admin {
    // DB Stuff
    private $conn;
    private $table = 'admins';

    // Properties
    public $Username;
    public $Password;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Admins
    public function get() {
      // Create query
      $query = 'SELECT Username, Password FROM ' . $this->table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Admin
    public function get_single(){
      // Create query
      $query = 'SELECT Username, Password FROM ' . $this->table . ' WHERE Username = ? LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(1, $this->Username);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Post Admin
    public function post() {
      // Create Query
      $query = 'INSERT INTO ' . $this->table . ' SET Username = :Username, Password = :Password';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Password = htmlspecialchars(strip_tags($this->Password));
      
      // Bind data
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Password', $this->Password);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Put Admin
    public function put() {
      // Create Query
      $query = 'UPDATE ' . $this->table . ' SET Password = :Password WHERE Username = :Username';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));
      $this->Password = htmlspecialchars(strip_tags($this->Password));
      
      // Bind data
      $stmt-> bindParam(':Username', $this->Username);
      $stmt-> bindParam(':Password', $this->Password);
      
      // Execute query
      if($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

    // Delete Admin
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE Username = :Username';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // clean data
      $this->Username = htmlspecialchars(strip_tags($this->Username));

      // Bind Data
      $stmt-> bindParam(':Username', $this->Username);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
      }
  }
