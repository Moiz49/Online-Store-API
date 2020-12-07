<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Order_contains.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Order_contains($db);

    // get id from URL
    $Sc->Order_Id = isset($_GET['Order_Id']) ? $_GET['Order_Id'] : die();
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();


    $Sc->Get_single();

    $sc_arr = array(
      'Order_Id' => $Sc->Order_Id,
      'Art_Id' => $Sc->Art_Id,
      'Amount' => $Sc->Amount
    );

    print_r(json_encode($sc_arr));

    ?>
