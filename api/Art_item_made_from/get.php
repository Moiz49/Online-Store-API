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
          'Art_Id' => $Art_Id,
          'Mat_Id' => $Mat_Id,
          'Mat_name' => $Mat_name,
          'M_qty_each_item' => $M_qty_each_item
        );

        //push to "data"
        array_push($sc_arr, $sc_item);
      }
      //turn to Json
      echo json_encode($sc_arr);
    }else{
      // no shopping carts
      echo json_encode(array('message' => 'No Item found'));
    }
 ?>
