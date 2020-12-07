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
    $Sc = new Customer($db);

    // get id from URL
    $Sc->Customer_Id = isset($_GET['Customer_Id']) ? $_GET['Customer_Id'] : die();

    $Sc->Get_single();

    $sc_arr = array(
      'Customer_Id' => $Sc->Customer_Id,
      'Name_' => $Sc->Name_,
      'Email_address' => $Sc->Email_address,
      'Address' => $Sc->Address
    );

    print_r(json_encode($sc_arr));

    ?>
