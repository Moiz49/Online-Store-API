<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Art_item.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Art_item($db);

    // get id from URL
    $Sc->Art_Id = isset($_GET['Art_Id']) ? $_GET['Art_Id'] : die();

    $Sc->Get_single();

    $sc_arr = array(
      'Art_Id' => $Sc->Art_Id,
      'Art_name' => $Sc->Art_name,
      'Quantity' => $Sc->Quantity,
      'Price' => $Sc->Price,
      'Type_' => $Sc->Type_
    );

    print_r(json_encode($sc_arr));

    ?>
