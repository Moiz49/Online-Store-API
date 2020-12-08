<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/shopping_cart_contains.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new shopping_cart_contains($db);

    // get id from URL
    $Sc->Customer_Id = isset($_GET['Customer_Id']) ? $_GET['Customer_Id'] : die();

    // Get order
    $result = $Sc->Get_single();
  
    // Get row count
    $num = $result->rowCount();

    // Check if any Shopping_cart
    if($num > 0) {
      $arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
          'Customer_Id' => $Customer_Id,
          'Art_Id' => $Art_Id,
          'Art_name' => $Art_name,
          'Art_qty' => $Art_qty
        );

        // Push to "data"
        array_push($arr, $item);
      }

      // Turn to JSON & output
      echo json_encode($arr);
  
    } else {
      // No Shopping_cart
      echo json_encode(
        array('message' => 'No shopping_cart_contains Found')
      );
    }
