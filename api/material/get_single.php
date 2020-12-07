<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Material.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Material object
  $material = new Material($db);

  // Get Id
  $material->Mat_Id = isset($_GET['Mat_Id']) ? $_GET['Mat_Id'] : die();
  
  // Get material
  $result = $material->get_single();
  
  $row = $result->fetch(PDO::FETCH_ASSOC);
  
  if ($row != NULL){
    // Create array
    $arr = array(
      'Mat_Id' => $row['Mat_Id'],
      'Mat_name' => $row['Mat_name']
    );

    // Make JSON
    print_r(json_encode($arr));
  } else {
    echo json_encode(
      array('message' => 'No Material Found')
    );
  }