<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Supply_Order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Supply_Order object
  $order = new Supply_Order($db);

  // Get order
  $order->SO_Id = isset($_GET['SO_Id']) ? $_GET['SO_Id'] : die();
  
  // Get order
  $result = $order->get_single();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any order
  if($num > 0) {
    $arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $item = array(
        'SO_Id' => $SO_Id,
        'Supplier_name' => $Supplier_name
      );

      // Push to "data"
      array_push($arr, $item);
    }

    // Turn to JSON & output
    echo json_encode($arr);
  
  } else {
    // No Supply_Order
    echo json_encode(
      array('message' => 'No Supply_Order Found')
    );
  }