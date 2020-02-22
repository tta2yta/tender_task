<?php
//database settings
include "connectdb.php";
$query="select * from tender";
$data = array();
if($dbhandle->query($query)){
$rs=$dbhandle->query($query);
while ($row = $rs->fetch_array()) {
  $data[] = $row;
}

	//print_r($data);
    
  print json_encode($data);
}
else
  print json_encode($data);

?>

