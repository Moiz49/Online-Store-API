<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../Models/Orders.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Shopping_cart object
    $Sc = new Order($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));


    $Sc->Order_Id = $data->Order_Id;
    $Sc->Customer_Id = $data->Customer_Id;
    $Sc->Final_cost = $data->Final_cost;
    //$Sc->Art_Id = $data->Art_Id;

    if ($Sc->Put()){
      echo json_encode(array('message' => 'Order updated'));
    }else {
      echo json_encode(array('message' => 'Order not updated'));
    }

?>
