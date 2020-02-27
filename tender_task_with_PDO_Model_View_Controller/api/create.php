<?php

include_once '../model/tender.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tender = new tender($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

if(!isset($data->id) && !isset($data->doc) && !isset($data->name) && !isset($data->code) && !isset($data->year))
{
echo json_encode(
      array('message' => 'Please Enter Correct Values')
    );
return;
}
else{
  $tender->id = $data->id;
  $tender->doc = $data->doc;
  $tender->name = $data->name;
  $tender->code = $data->code;
  $tender->year = $data->year;
}
  // Create Tender
if($tender->check_id()==false)
{
  if($tender->create()) {
    echo json_encode(
      array('message' => 'Tender Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Tender Not Created, Please Enter Correct Values')
    );
  }
}
else
echo json_encode(
      array('message' => 'Id Already Existed Please Enter Another id')
    );



?>