<?php 
  class Air_mean{
    // DB conn
    private $conn;
    private $table = 'mean_air';


 		 public $id;
	public $co;
	public $nh3;
	public $no;
	public $no2;
	public $o3 ;
	public $so2;
	public $pm2_5;
	public $pm10;
	public $Date;
	public $loca_id;
	
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
	
	public function create() {
         // Create query
		  
		  
          $query = 'INSERT INTO ' . $this->table . ' SET id=0  ,co = :co, nh3 = :nh3, no = :no, no2 = :no2, o3= :o3,
							so2 = :so2,	 pm2_5 = :pm2_5, pm10= :pm10, loca_id=:loca_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

      

          // Bind data
          $stmt->bindParam(':co', $this->co );
          $stmt->bindParam(':nh3', $this->nh3);
          $stmt->bindParam(':no', $this->no);
          $stmt->bindParam(':no2', $this->no2);
		  $stmt->bindParam(':o3', $this->o3);
		  $stmt->bindParam(':so2', $this->so2);
		  $stmt->bindParam(':pm2_5', $this->pm2_5);
		  $stmt->bindParam(':pm10', $this->pm10);
		  $stmt->bindParam(':loca_id', $this->loca_id);	
		  
          // Execute query
          if($stmt->execute()) {
            return true;
    } // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
	
	public function read(){
		
		
		// Create query
          $query = 'SELECT
		*
		FROM 
			' . $this->table . ' WHERE loca_id = '.$this->loca_id.'
                                    ORDER BY mean_id DESC LIMIT 1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);


          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
  
         // Set properties
          $this->co = $row['co'];
          $this->nh3= $row['nh3'];
          $this->no = $row['no'];
          $this->no2 = $row['no2'];
          $this->o3 = $row['o3'];
		  $this->pm2_5 = $row['pm2_5'];
		  $this->pm10 = $row['pm10'];
		  $this->loca_id = $row['loca_id'];
	      $this->Date = $row['Date'];
		 $this->so2 = $row['so2'];
	}
  }