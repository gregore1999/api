<?php 
class Location{
    // DB conn
    private $conn;
    private $table = 'location';

    // Location Properties
 	 public $Loc_id;
	public $City;
	public $lat;
	public $longit;
	
	
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
	
	 public function create() {
          // Create query
		  
		  
          $query = 'INSERT INTO ' . $this->table . ' SET  City = :City, lat = :lat, longit = :longit';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

      

          // Bind data
          $stmt->bindParam(':City', $this->City );
          $stmt->bindParam(':lat', $this->lat);
          $stmt->bindParam(':longit', $this->longit);
		
          // Execute query
          if($stmt->execute()) {
			  $stmt->closeCursor();
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
	  $stmt->closeCursor();

      return false;
    }
	
	 public function read() {
      // Create query
      $query = "SELECT
			*
		FROM
			" . $this->table . "
			WHERE `City` = '". $this->City."';";
		
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
	
	public function read_coord() {
      // Create query
      $query = "SELECT
			*
		FROM
			" . $this->table." WHERE `lat` = '". $this->lat."'AND
		 `lat` = '". $this->longit."' ;";
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }


 public function get_single() {
          // Create query
          $query = 	"SELECT *  FROM ". $this->table ." WHERE `City` = '". $this->City."';";

          // Prepare statement
          $stmt = $this->conn->prepare($query);


          // Execute query
          $stmt->execute();

         $row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
		 $this->Loc_id = $row['Loc_id'];
		
 
  return $stmt;
        
        
  
    }
	 public function get_single_coord() {
          // Create query
          $query = "	SELECT * FROM `location` WHERE `lat` LIKE '".$this->lat."' AND `longit` LIKE '".$this->longit."'";

          // Prepare statement
          $stmt = $this->conn->prepare($query);


          // Execute query
          $stmt->execute();

         $row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		 $this->Loc_id = $row['Loc_id'];
    
  return $stmt;
        
        
  
    }
}