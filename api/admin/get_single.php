<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Admin.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Admin object
  $admin = new Admin($db);

  // Get Username
  $admin->Username = isset($_GET['Username']) ? $_GET['Username'] : die();
  
  // Get admin
  $result = $admin->get_single();
  
  $row = $result->fetch(PDO::FETCH_ASSOC);
  
  if ($row != NULL){
    // Create array
    $arr = array(
      'Username' => $row['Username'],
      'Password' => $row['Password']
    );

    // Make JSON
    print_r(json_encode($arr));
  } else {
    echo json_encode(
      array('message' => 'No Admin Found')
    );
  }