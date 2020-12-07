<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Manage_Inventory.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Manage_Inventory object
  $inventory = new Manage_Inventory($db);

  // Get Username
  $inventory->Username = isset($_GET['Username']) ? $_GET['Username'] : die();
  
  // Get inventory
  $result = $inventory->get_single();
  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any inventory
  if($num > 0) {
    $arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $item = array(
        'Username' => $Username,
        'Mat_Id' => $Mat_Id,
        'Mat_name' => $Mat_name,
        'M_qty' => $M_qty
      );

      // Push to "data"
      array_push($arr, $item);
    }

    // Turn to JSON & output
    echo json_encode($arr);
  
  } else {
    // No inventory
    echo json_encode(
      array('message' => 'No inventory Found')
    );
  }
