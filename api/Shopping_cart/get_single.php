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
    $Sc->Order_Id = isset($_GET['Customer_Id']) ? $_GET['Customer_Id'] : die();

    $Sc->Get_single();

    $sc_arr = array(
      'Customer_Id' => $Sc->Customer_Id,
      'Art_Id' => $Sc->Art_Id,
      'Total_cost' => $Sc->Total_cost
    );

    print_r(json_encode($sc_arr));

    ?>
