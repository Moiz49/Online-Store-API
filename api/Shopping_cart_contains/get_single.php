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

    // get id from URL
    $Sc->Customer_Id = isset($_GET['Customer_Id']) ? $_GET['Customer_Id'] : die();
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();
    $Sc->Amount = isset($_GET['Amount']) ? $_GET['Amount'] : die();


    $Sc->Get_single();

    $sc_arr = array(
      'Customer_Id' => $Sc->Customer_Id,
      'Art_Id' => $Sc->Art_Id,
      'Amount' => $Sc->Amount
    );

    print_r(json_encode($sc_arr));

    ?>
