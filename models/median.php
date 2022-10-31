<?php 
  class Median {
    // DB conn
    private $conn;
    private $table = 'median';

    // Median Properties
 	 public $median_id;
	public $temp;
	public $temp_min;
	public $temp_max;
	public $feels_like;
	public $humidity ;
	public $Date;
	public $loca_id;
	
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
	
	public function create() {
          // Create query
		  
		  
          $query = 'INSERT INTO ' . $this->table . ' SET median_id=0  ,temp = :temp, temp_max = :temp_max, temp_min = :temp_min, feels_like = :feels_like, humidity= :humidity,
								 loca_id = :loca_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

      

          // Bind data
          $stmt->bindParam(':temp', $this->temp );
          $stmt->bindParam(':temp_max', $this->temp_max);
          $stmt->bindParam(':temp_min', $this->temp_min);
          $stmt->bindParam(':feels_like', $this->feels_like);
		  $stmt->bindParam(':humidity', $this->humidity);
		  $stmt->bindParam(':loca_id', $this->loca_id);
		
		  
          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
	public function read(){
		
		
		// Create query
          $query = 'SELECT
		*
		FROM 
			' . $this->table . ' WHERE loca_id = '.$this->loca_id.'
                                    ORDER BY median_id DESC LIMIT 1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);


          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
  
          // Set properties
          $this->temp = $row['temp'];
          $this->temp_max= $row['temp_max'];
          $this->temp_min = $row['temp_min'];
          $this->humidity = $row['humidity'];
          $this->feels_like = $row['feels_like'];
	 $this->Date = $row['Date'];
		
	}
  }