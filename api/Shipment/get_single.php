<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../Models/Shipment.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Shipment($db);

    // get id from URL
    $Sc->Order_Id = isset($_GET['Order_Id']) ? $_GET['Order_Id'] : die();

    $Sc->Get_single();

    $sc_arr = array(
      'Order_Id' => $Sc->Order_Id,
      'Status_' => $Sc->Status_,
      'Scompany' => $Sc->Scompany,
      'Ship_date' => $Sc->Ship_date,
      'Destination' => $Sc->Destination
    );

    print_r(json_encode($sc_arr));

    ?>
