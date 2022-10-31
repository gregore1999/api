<?php 
  class Weather {
    // DB conn
    private $conn;
    private $table = 'weather';

    // Weather Properties
 	 public $id;
	public $temp;
	public $temp_min;
	public $temp_max;
	public $feels_like;
	public $humidity ;
	public $Date;
	public $loca_id;
	public $sunrise;
	public $sunset;
	public $conditions;
	
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get weather
    public function read() {
      // Create query
      $query = 'SELECT
			*
		FROM
			' . $this->table . '
			WHERE `loca_id` = '. $this->loca_id.'
			ORDER BY
			w_id ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

 public function create() {
          // Create query
		  
		  
          $query = 'INSERT INTO ' . $this->table . ' SET w_id=0  ,temp = :temp, temp_max = :temp_max, temp_min = :temp_min, feels_like = :feels_like, humidity= :humidity,
								sunrise = :sunrise, sunset = :sunset, loca_id = :loca_id, conditions = :conditions';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

      

          // Bind data
          $stmt->bindParam(':temp', $this->temp );
          $stmt->bindParam(':temp_max', $this->temp_max);
          $stmt->bindParam(':temp_min', $this->temp_min);
          $stmt->bindParam(':feels_like', $this->feels_like);
		  $stmt->bindParam(':humidity', $this->humidity);
		  $stmt->bindParam(':sunrise', $this->sunrise);
		  $stmt->bindParam(':sunset', $this->sunset);
		  $stmt->bindParam(':loca_id', $this->loca_id);
		  $stmt->bindParam(':conditions', $this->conditions);		
		  
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


 public function read_single() {
          // Create query
          $query = 'SELECT
			*
		FROM
			' . $this->table . '
                                    WHERE
                                      Date = ? && loca_id ='.$this->loca_id.'
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->Date);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
  
          // Set properties
          $this->temp = $row['temp'];
          $this->temp_max= $row['temp_max'];
          $this->temp_min = $row['temp_min'];
          $this->humidity = $row['humidity'];
          $this->feels_like = $row['feels_like'];
		  $this->sunrise = $row['sunrise'];
          $this->sunset = $row['sunset'];
		  $this->conditions = $row['conditions'];
  
    }
	
	

 
}