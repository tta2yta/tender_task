<?php 
  // Headers
  // header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


 include_once '../model/tender.php';

// echo json_encode(
//           array('message' => 'No Tenders Found')
//         );

 // $result=new tender1();
 // $tender_list=$result->read();
 // echo json_encode($tender_list);

 // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate 
  $tender = new tender($db);

  // tender read query
  $result = $tender->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any Tenders
  if($num > 0) {
        // Cat array
       // $ten_arr = array();
        $ten_arr['data_item'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $ten_item = array(
            'Id' => $Id,
            'Date_of_Creation' => $Date_of_Creation,
            'Name'=>$Name,
            'Code'=>$Code,
            'Year'=>$Year
          );

          // Push to "data"
          array_push($ten_arr['data_item'], $ten_item);
        }

        // Turn to JSON & output
        echo json_encode($ten_arr);

  } else {
        // No Tenders
        echo json_encode(
          array('message' => 'No Tenders Found')
        );
       
  }


?>