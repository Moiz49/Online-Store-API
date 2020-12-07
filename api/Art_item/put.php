<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type,
    Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../Models/Art_item.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Art_item($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));


    $Sc->Art_Id = $data->Art_Id;
    $Sc->Art_name = $data->Art_name;
    $Sc->Quantity = $data->Quantity;
    $Sc->Price = $data->Price;
    $Sc->Type_ = $data->Type_;

    if ($Sc->Put()){
      echo json_encode(array('message' => 'Art_item updated'));
    }else {
      echo json_encode(array('message' => 'Art_item not updated'));
    }

?>
