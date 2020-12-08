<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    if ($Sc->Delete()){
      echo json_encode(array('message' => 'Order Deleted'));
    }else {
      echo json_encode(array('message' => 'Order not Deleted'));
    }

?>
