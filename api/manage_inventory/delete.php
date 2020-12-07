<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Manage_Inventory.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Manage_Inventory object
  $inventory = new Manage_Inventory($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set Username to delete
  $inventory->Username = $data->Username;
  $inventory->Mat_Id = $data->Mat_Id;

  // Delete Inventory
  if($inventory->delete()) {
    echo json_encode(
      array('message' => 'Inventory deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Inventory not deleted')
    );
  }
