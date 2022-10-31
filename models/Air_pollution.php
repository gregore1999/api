<?php 
  class Air_pollution {
    // DB conn
    private $conn;
    private $table = 'air_pollution';

    // Air_pollution Properties
 		 public $id;
	public $co;
	public $nh3;
	public $no;
	public $no2;
	public $o3 ;
	public $pm2_5;
	public $so2;
	public $pm10;
	public $quality;
	public $Date;
	public $loca_id;
	
	
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
			id ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

 public function create() {
          // Create query
		  
		  
          $query = 'INSERT INTO ' . $this->table . ' SET id=0  ,co = :co, nh3 = :nh3, no = :no, no2 = :no2, o3= :o3,
								so2 = :so2, pm2_5 = :pm2_5, pm10= :pm10, loca_id=:loca_id, quality=:quality';
          // Prepare statement
          $stmt = $this->conn->prepare($query);

      

        
          // Bind data
          $stmt->bindParam(':co', $this->co );
          $stmt->bindParam(':nh3', $this->nh3);
          $stmt->bindParam(':no', $this->no);
          $stmt->bindParam(':no2', $this->no2);
		  $stmt->bindParam(':so2', $this->so2);
		  $stmt->bindParam(':o3', $this->o3);
		  $stmt->bindParam(':pm2_5', $this->pm2_5);
		  $stmt->bindParam(':pm10', $this->pm10);
		  $stmt->bindParam(':loca_id', $this->loca_id);	
		  $stmt->bindParam(':quality', $this->quality);
		  
          // Execute query
          if($stmt->execute()) {
			 
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
	 

      return false;
    }


 public function read_single() {
          // Create query
          $query = 'SELECT
			*
		FROM
			' . $this->table . '
                                    WHERE
                                      Date = ?
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