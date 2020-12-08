<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,   Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Shipment.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Shipment($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));


    $Sc->Order_Id = $data->Order_Id;
    $Sc->Status_ = $data->Status_;
    $Sc->Scompany = $data->Scompany;
    $Sc->Ship_date = $data->Ship_date;
    $Sc->Destination = $data->Destination;

    if ($Sc->Put()){
      echo json_encode(array('message' => 'Shipment updated'));
    }else {
      echo json_encode(array('message' => 'Shipment not updated'));
    }

?>
