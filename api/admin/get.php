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

  // Admin get query
  $result = $admin->get();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any admin
  if($num > 0) {
    $arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $item = array(
        'Username' => $Username,
        'Password' => $Password
      );

      // Push to arr
      array_push($arr, $item);
    }

    // Turn to JSON & output
    echo json_encode($arr);
  
  } else {
    // No Categories
    echo json_encode(
      array('message' => 'No Admin Found')
    );
  }
