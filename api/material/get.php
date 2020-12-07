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

  // Material get query
  $result = $material->get();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any Material
  if($num > 0) {
    $arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $item = array(
        'Mat_Id' => $Mat_Id,
        'Mat_name' => $Mat_name
      );

      // Push to "data"
      array_push($arr, $item);
    }

    // Turn to JSON & output
    echo json_encode($arr);
  
  } else {
    // No Categories
    echo json_encode(
      array('message' => 'No Materials Found')
    );
  }
