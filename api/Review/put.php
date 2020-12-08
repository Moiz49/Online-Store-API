<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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
    $Sc->Cname = $data->Cname;
    $Sc->Review = $data->Review;
    $Sc->Date_ = $data->Date_;
    $Sc->Rating = $data->Rating;

    if ($Sc->Put()){
      echo json_encode(array('message' => 'Review updated'));
    }else {
      echo json_encode(array('message' => 'Review not updated'));
    }

?>
