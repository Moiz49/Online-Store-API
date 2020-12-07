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

    $Sc->Get_single();

    $sc_arr = array(
      'Order_Id' => $Sc->Order_Id,
      'Customer_Id' => $Sc->Customer_Id,
      'Final_cost' => $Sc->Final_cost,
      'Art_Id' => $Sc->Art_Id
    );

    print_r(json_encode($sc_arr));

    ?>
