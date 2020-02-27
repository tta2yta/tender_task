<?php 
include_once "../Database.php";
  class tender {
    // DB stuff
    //private $conn;
    private $table = 'tender';

    // Post Properties
    public $id;
    public $doc;
    public $name;
    public $code;
    public $year;

    // Constructor with DB
    public function __construct($db) {
     $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
     $query="select * from tender";
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);
 //$stmt = conn->prepare($query);
      // Execute query
      $stmt->execute();

      return $stmt;
    }

//Checking Id already exist or not
    public function check_id(){
      $flag=false;

      $this->id = htmlspecialchars(strip_tags($this->id));

$sql = "SELECT Id FROM tender WHERE Id='$this->id'";

$row_count =$this->conn->prepare($sql);
$row_count->execute();
if($row_count->rowCount() > 0 ){
   $flag=true;
   return $flag ;
}

    }


 // Create Tender
  public function create() {
    // Create Query
  $query = 'INSERT INTO ' .
      $this->table . '
    SET
      Id = :id,
      Date_of_Creation= :doc,
      Name=:name, Code=:code, Year=:year
      ';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);
   // Clean data
 $this->id = htmlspecialchars(strip_tags($this->id));
  $doc_val = htmlspecialchars(strip_tags($this->doc));
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->code = htmlspecialchars(strip_tags($this->code));
  $this->year = htmlspecialchars(strip_tags($this->year));
  $this->doc=date('Y-m-d', strtotime($doc_val)); 

  // Bind data
  $stmt-> bindParam(':id', $this->id);
    $stmt-> bindParam(':doc', $this->doc);
      $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':code', $this->code);
          $stmt-> bindParam(':year', $this->year);

  // Execute query
          try{
  if($stmt->execute()) {
    return true;
  }
}
  // Print error if something goes wrong
  //printf("Error: $s.\n", $stmt->error);
catch (Exception $e){
  return false;
}
  }


// Update Tenedr
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
     Date_of_Creation= :doc,
      Name=:name,
      Code=:code,
      Year=:year
      WHERE
      Id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

// Clean data
 $this->id = htmlspecialchars(strip_tags($this->id));
  $doc_val = htmlspecialchars(strip_tags($this->doc));
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->code = htmlspecialchars(strip_tags($this->code));
  $this->year = htmlspecialchars(strip_tags($this->year));
  $this->doc=date('Y-m-d', strtotime($doc_val)); 
$this->doc=date('Y-m-d', strtotime($doc_val)); 
  // Bind data
  $stmt-> bindParam(':id', $this->id);
    $stmt-> bindParam(':doc', $this->doc);
      $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':code', $this->code);
          $stmt-> bindParam(':year', $this->year);

  // Execute query
          try{
  if($stmt->execute()) {
    return true;
  }
}
  // Print error if something goes wrong
  //printf("Error: $s.\n", $stmt->error);
catch (Exception $e){
  return false;
}
  }


// Delete Tender
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE Id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
          try{
  if($stmt->execute()) {
    return true;
  }
}
  // Print error if something goes wrong
  //printf("Error: $s.\n", $stmt->error);
catch (Exception $e){
  return false;
}

   }
 }
   ?>