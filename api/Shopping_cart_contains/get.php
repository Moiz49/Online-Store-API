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

    // call the get method
    $result = $Sc->Get();
    // get num of rows
    $num = $result->rowCount();

    // check is any shopping_cart exist
    if ($num >0){
      $sc_arr = array();
      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $sc_item = array(
          'Customer_Id' => $Customer_Id,
          'Art_Id' => $Art_Id,
          'Art_name' => $Art_name,
          'Art_qty' => $Art_qty
        );

        //push to "data"
        array_push($sc_arr, $sc_item);
      }
      //turn to Json
      echo json_encode($sc_arr);
    }else{
      // no shopping carts
      echo json_encode(array('message' => 'No shopping carts found'));
    }
 ?>
