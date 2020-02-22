<?php  

include "connectdb.php";
$data=json_decode(file_get_contents("php://input"));
$id=$data->id;

$query="DELETE FROM Tender WHERE Id=".$id;

if($dbhandle->query($query))
	{
    echo json_encode(
      array('message' => 'Record Deleted')
    );
  } else {
  	$err=mysqli_error($dbhandle);
    echo json_encode(
      array('message' => "Pease Enter Correct values and Try Again")
    );
  }






 ?>