<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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
  $material->Mat_name = $data->Mat_name;

  // Update post
  if($material->put()) {
    echo json_encode(
      array('message' => 'Material Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Material not updated')
    );
  }
