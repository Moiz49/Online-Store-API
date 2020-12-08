<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Art_item.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Art_item object
    $Sc = new Art_item($db);

    // get id from URL
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();


    // Get Art_item
    $result = $Sc->Get_single();
  
    $row = $result->fetch(PDO::FETCH_ASSOC);
  
    if ($row != NULL){
      // Create array
      $arr = array(
        'Art_Id' => $row['Art_Id'],
        'Art_name' => $row['Art_name'],
        'Quantity' => $row['Quantity'],
        'Price' => $row['Price'],
        'Type_' => $row['Type_']
      );

      // Make JSON
      print_r(json_encode($arr));
    } else {
      echo json_encode(
      array('message' => 'No Art_item Found')
      );
    }
