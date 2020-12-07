<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Material.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Material object
  $material = new Material($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $material->Mat_Id = $data->Mat_Id;

  // Delete post
  if($material->delete()) {
    echo json_encode(
      array('message' => 'Material deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Material not deleted')
    );
  }
