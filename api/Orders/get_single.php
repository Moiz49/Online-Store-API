<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Orders.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Orders($db);

    // get id from URL
    $Sc->Order_Id = isset($_GET['Order_Id']) ? $_GET['Order_Id'] : die();

    // Get order
    $result = $Sc->Get_single();
  
    // Get row count
    $num = $result->rowCount();

    // Check if any Order
    if($num > 0) {
      $arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
          'Order_Id' => $Order_Id,
          'Customer_Id' => $Customer_Id,
          'Final_cost' => $Final_cost
        );

        // Push to "data"
        array_push($arr, $item);
      }

      // Turn to JSON & output
      echo json_encode($arr);
  
    } else {
      // No Order
      echo json_encode(
        array('message' => 'No Order Found')
      );
    }
