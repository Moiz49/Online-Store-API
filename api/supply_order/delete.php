<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Supply_Order.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Supply_Order object
  $order = new Supply_Order($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $order->SO_Id = $data->SO_Id;

  // Delete Order
  if($order->delete()) {
    echo json_encode(
      array('message' => 'Order deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Order not deleted')
    );
  }
