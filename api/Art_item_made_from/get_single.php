<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Art_item_made_from.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Art_item_made_from object
    $Sc = new Art_item_made_from($db);

    // get id from URL
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();

        // Get order
    $result = $Sc->Get_single();
  
    // Get row count
    $num = $result->rowCount();

    // Check if any Art_item_made_from
    if($num > 0) {
      $arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
          'Art_Id' => $Art_Id,
          'Mat_Id' => $Mat_Id,
          'Mat_name' => $Mat_name,
          'M_qty_each_item' => $M_qty_each_item
        );

        // Push to "data"
        array_push($arr, $item);
      }

      // Turn to JSON & output
      echo json_encode($arr);
  
    } else {
      // No Shopping_cart
      echo json_encode(
        array('message' => 'No Art_item_made_from Found')
      );
    }