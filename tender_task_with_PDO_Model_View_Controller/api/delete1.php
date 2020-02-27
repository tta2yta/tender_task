<?php
  include_once '../model/tender.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate 
  $tender = new tender($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $tender->id = $data->id;

  // Delete post
  if($tender->delete()) {
    echo json_encode(
      array('message' => 'Tender deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Tender not deleted')
    );
  }

?>