<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,   Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
    include_once '../../config/Database.php';
    include_once '../../models/Review.php';

    // start db and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Review object
    $Sc = new Review($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $Sc->Art_Id = $data->Art_Id;
    $Sc->Customer_Id = $data->Customer_Id;

    if ($Sc->Delete()){
      echo json_encode(array('message' => 'Review Deleted'));
    }else {
      echo json_encode(array('message' => 'Review not Deleted'));
    }

?>
