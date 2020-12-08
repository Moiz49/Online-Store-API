<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Customer.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $customer = new Customer($db);

    // get id from URL
    $customer->Customer_Id = isset($_GET['Customer_Id']) ? $_GET['Customer_Id'] : die();

    $result = $customer->Get_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);

    if ($row != NULL){
      // Create array
      $arr = array(
        'Customer_Id' => $row['Customer_Id'],
        'Name_' => $row['Name_'],
        'Email_address' => $row['Email_address'],
        'Address' => $row['Address']
      );

      // Make JSON
      print_r(json_encode($arr));
    } else {
      echo json_encode(
        array('message' => 'No Admin Found')
      );
    }
