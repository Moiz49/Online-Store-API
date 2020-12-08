<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,   Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Order_contains.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Order_contains($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));


    $Sc->Order_Id = $data->Order_Id;
    $Sc->Art_Id = $data->Art_Id;
    $Sc->Art_qty = $data->Art_qty;

    if ($Sc->Put()){
      echo json_encode(array('message' => 'Order updated'));
    }else {
      echo json_encode(array('message' => 'Order not updated'));
    }

?>
