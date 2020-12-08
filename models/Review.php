<?php
  class Review{
      // DB connections
      private $conn;
      private $table = 'review';

      public $Customer_Id;
      public $Art_Id;
      public $Cname;
      public $Review;
      public $Date_;
      public $Rating;

      // constructor with DB
      public function __construct($db){
        $this->conn = $db;
      }

      // Get reviews
      public function Get(){
        // Create query
        $query = 'SELECT R.Art_Id, A.Art_name, R.Customer_Id, R.Cname, R.Review, R.Date_, R.Rating 
                  FROM ' . $this->table . ' AS R
                  LEFT JOIN art_item AS A ON R.Art_Id = A.Art_Id
                  ORDER BY R.Art_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
      }

      // get single review
      public function Get_single(){
        // Create query
        $query = 'SELECT R.Art_Id, A.Art_name, R.Customer_Id, R.Cname, R.Review, R.Date_, R.Rating 
                  FROM ' . $this->table . ' AS R
                  LEFT JOIN art_item AS A ON R.Art_Id = A.Art_Id
                  WHERE R.Art_Id = :Art_Id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Art_Id', $this->Art_Id);

        $stmt->execute();

        return $stmt;
      }

      public function Post(){
        $query = 'INSERT INTO ' .$this->table . '
        SET Art_Id = :Art_Id,
            Customer_Id = :Customer_Id,
            Cname = :Cname,
            Review = :Review,
            Date_ = :Date_,
            Rating = :Rating';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Cname = htmlspecialchars(strip_tags($this->Cname));
        $this->Review = htmlspecialchars(strip_tags($this->Review));
        $this->Date_ = htmlspecialchars(strip_tags($this->Date_));
        $this->Rating = htmlspecialchars(strip_tags($this->Rating));

        //bind the data
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Cname', $this->Cname);
        $stmt->bindParam(':Review', $this->Review);
        $stmt->bindParam(':Date_', $this->Date_);
        $stmt->bindParam(':Rating', $this->Rating);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
      }

      public function Put(){
        $query = 'UPDATE ' .$this->table . ' 
        SET Cname = :Cname,
            Review = :Review,
            Date_ = :Date_,
            Rating = :Rating
        WHERE Art_Id = :Art_Id AND Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));
        $this->Cname = htmlspecialchars(strip_tags($this->Cname));
        $this->Review = htmlspecialchars(strip_tags($this->Review));
        $this->Date_ = htmlspecialchars(strip_tags($this->Date_));
        $this->Rating = htmlspecialchars(strip_tags($this->Rating));

        //bind the data
        $stmt->bindParam(':Art_Id', $this->Art_Id);
        $stmt->bindParam(':Customer_Id', $this->Customer_Id);
        $stmt->bindParam(':Cname', $this->Cname);
        $stmt->bindParam(':Review', $this->Review);
        $stmt->bindParam(':Date_', $this->Date_);
        $stmt->bindParam(':Rating', $this->Rating);

        // execute
        if ($stmt->execute()){
          return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
      }

      public function Delete(){
        $query = 'DELETE FROM ' . $this->table . ' 
                  WHERE Art_Id = :Art_Id AND Customer_Id = :Customer_Id';

        // prepare Statement
        $stmt = $this->conn->prepare($query);

        //clean Data
        $this->Art_Id = htmlspecialchars(strip_tags($this->Art_Id));
        $this->Customer_Id = htmlspecialchars(strip_tags($this->Customer_Id));

        //bind the data
        $stmt->bindParam(':Art_Id', $this->Art_Id);
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
