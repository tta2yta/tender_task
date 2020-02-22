<?php 
  class tender {
    // DB stuff
    private $conn;
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

      // Execute query
      $stmt->execute();

      return $stmt;
    }

   }