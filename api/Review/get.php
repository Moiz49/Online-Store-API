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

    // call the get method
    $result = $Sc->Get();

    // get num of rows
    $num = $result->rowCount();

    // check is any Reviews exist
    if ($num >0){
      $sc_arr = array();
      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $sc_item = array(
          'Art_Id' => $Art_Id,
          'Art_name' => $Art_name,
          'Customer_Id' => $Customer_Id,
          'Cname' => $Cname,
          'Review' => $Review,
          'Date_' => $Date_,
          'Rating' => $Rating
        );

        //push to "data"
        array_push($sc_arr, $sc_item);
      }
      //turn to Json
      echo json_encode($sc_arr);
    }else{
      // no shopping carts
      echo json_encode(array('message' => 'No Reviews found'));
    }
 ?>
