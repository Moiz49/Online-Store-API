<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,    Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
    include_once '../../config/Database.php';
    include_once '../../models/Art_item_made_from.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Art_item_made_from object
    $Sc = new Art_item_made_from($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $Sc->Mat_Id = $data->Mat_Id;
    $Sc->Art_Id = $data->Art_Id;
    $Sc->M_qty_each_item = $data->M_qty_each_item;

    if ($Sc->Post()){
      echo json_encode(array('message' => 'Art_item_made_from made'));
    }else {
      echo json_encode(array('message' => 'Art_item_made_from not made'));
    }

?>
