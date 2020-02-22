<?php
include "connectdb.php";
$data=json_decode(file_get_contents("php://input"));

$btnName=$dbhandle->real_escape_string($data->btnName);
$id=$dbhandle->real_escape_string($data->id);

$sql = "SELECT Id FROM tender WHERE Id='$id'";

$result =$dbhandle->query($sql);
if(mysqli_num_rows($result) >0 and $btnName=="Insert"){
   echo json_encode(
      array('message' => 'Id Already Existed Please Enter Another id')
    );
}else if($btnName=='Insert'){
   //not found
$doc=$dbhandle->real_escape_string($data->doc);
$name=$dbhandle->real_escape_string($data->name);
$code=$dbhandle->real_escape_string($data->code);
$year=$dbhandle->real_escape_string($data->year);

$doc=date('Y-m-d', strtotime($doc)); 



$query="INSERT INTO tender VALUES($id,'".$doc."', '".$name."', '".$code."', '".$year."')";

if($dbhandle->query($query))
	{
    echo json_encode(
      array('message' => 'Tender Created')
    );
  } else {
  	$err=mysqli_error($dbhandle);
    echo json_encode(
      array('message' => "Pease Enter Correct values and Try Again")
    );
  }
	}

	else {

		$id=$dbhandle->real_escape_string($data->id);
$doc=$dbhandle->real_escape_string($data->doc);
$name=$dbhandle->real_escape_string($data->name);
$code=$dbhandle->real_escape_string($data->code);
$year=$dbhandle->real_escape_string($data->year);
       	$query="UPDATE tender SET Date_of_Creation = '".$doc."',
Name = '".$name."',
Code = '".$code."',
year = '".$year."'

       	WHERE Id=$id ";
if($dbhandle->query($query))
	{
    echo json_encode(
      array('message' => 'Record Updated')
    );
  } else {
  	$err=mysqli_error($dbhandle);
    echo json_encode(
      array('message' => "Pease Enter Correct values and Try Again")
    );
  }
}


?>