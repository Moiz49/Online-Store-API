<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Shopping_cart.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Shopping_cart($db);

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
          'Total_cost' => $Total_cost
          //'Art_Id' => $Art_Id,
          //'Art_name' => $Art_name
        );

        // Push to "data"
        array_push($arr, $item);
      }

      // Turn to JSON & output
      echo json_encode($arr);
  
    } else {
      // No Shopping_cart
      echo json_encode(
        array('message' => 'No Shopping_cart Found')
      );
    }
