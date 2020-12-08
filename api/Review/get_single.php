<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Review.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Review object
    $Sc = new Review($db);

    // get id from URL
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();

    // Get order
    $result = $Sc->Get_single();
  
    // Get row count
    $num = $result->rowCount();

    // Check if any Review
    if($num > 0) {
      $arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
          'Art_Id' => $Art_Id,
          'Art_name' => $Art_name,
          'Customer_Id' => $Customer_Id,
          'Cname' => $Cname,
          'Review' => $Review,
          'Date_' => $Date_,
          'Rating' => $Rating
        );

        // Push to "data"
        array_push($arr, $item);
      }

      // Turn to JSON & output
      echo json_encode($arr);
  
    } else {
      // No Shopping_cart
      echo json_encode(
        array('message' => 'No Review Found')
      );
    }