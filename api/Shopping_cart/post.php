<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type,
    Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../Models/Shopping_cart.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Shopping_cart($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $Sc->Customer_Id = $data->Customer_Id;
    //$Sc->Art_Id = $data->Art_Id;
    $Sc->Total_cost = $data->Total_cost;

    if ($Sc->Post()){
      echo json_encode(array('message' => 'Shopping cart made'));
    }else {
      echo json_encode(array('message' => 'Shopping cart not made'));
    }

?>
