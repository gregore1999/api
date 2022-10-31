<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/location.php';
  include_once '../models/Air_mean.php';
  include_once '../models/Air_median.php';
    include_once '../models/Air_pollution.php';
	
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate weather objects
  $air_pollution = new Air_pollution($db);
  $location = new Location($db);
  $air_mean = new Air_mean($db);
  $air_median = new Air_median($db);

  if(isset($_GET['lat'])&&isset($_GET['longit'])){
		$lat = $_GET['lat'] ;
		$longit= $_GET['longit'];
		// Get raw air_pollution data with lat and lon
		$api_data = file_get_contents("http://api.openweathermap.org/data/2.5/air_pollution?lat=".$lat."&lon=".$longit."&appid=94a9ca9f85b08f12596da8b2d4335c9f");
		$data = json_decode( $api_data,true);
	  $location->longit = $longit;
	  $location->lat = $lat;
  }
  
  
	
	$longitbool=isset($_GET['longit']);
	$latbool=isset($_GET['lat']);
	
	 
	 
  if( (!$latbool&&$longitbool) || ($latbool&&!$longitbool) ){
		die();
  }

	$result_loc = $location->read_coord();
	
	$location->get_single_coord();


    $air_pollution->co = $data['list'][0]['components']['co'];
  $air_pollution->no = $data['list'][0]['components']['no'];
  $air_pollution->no2 = $data['list'][0]['components']['no2'];
  $air_pollution->o3 = $data['list'][0]['components']['o3'];
  $air_pollution->so2 = $data['list'][0]['components']['so2'];
  $air_pollution->pm2_5 = $data['list'][0]['components']['pm2_5'];
  $air_pollution->loca_id = $location->Loc_id;
  $air_pollution->pm10 = $data['list'][0]['components']['pm10'];
  $air_pollution->nh3 = $data['list'][0]['components']['nh3'];
   $air_pollution->quality = $data['list'][0]['main']['aqi'];
  

  // Create air_pollution
  $air_pollution->create();
   
	
	//air_pollution query
  $result = $air_pollution->read();
  // Get row count
  $num = $result->rowCount();
  
  //check if we have enough data
  if($num > 9) {
    // weather array
    $weathers_arr = array();
    //fetch data 
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $weather_item = array(
        'id' => $id,
 		'co' => $co,
 		'no' => $no,
 		'no2' => $no2,
 		'o3' => $o3,
 		'so2' => $so2,
		'pm2_5' => $pm2_5,
		'pm10' => $pm10,
		'nh3' => $nh3,
 		'Date' => $Date
      );

      // Push to weather_arr
      array_push($weathers_arr, $weather_item);
     
    }
$i = ($num-1);
$co_mean=0;
$no_max_mean=0;
$no2_max_mean=0;
$o3_mean=0;
$so2_mean=0;
$pm2_5_mean=0;
$pm10_mean=0;
$nh3_mean=0;

// sum the last 10 data
while($i>=$num-10){
	$co_mean=$co_mean+$weathers_arr[$i]['co'];
	$no_max_mean+=$weathers_arr[$i]['no'];
	$no2_max_mean+=$weathers_arr[$i]['no2'];
	$o3_mean+=$weathers_arr[$i]['o3'];
	$so2_mean+=$weathers_arr[$i]['so2'];
	$pm2_5_mean+=$weathers_arr[$i]['pm2_5'];
	$pm10_mean+=$weathers_arr[$i]['pm10'];
	$nh3_mean+=$weathers_arr[$i]['nh3'];
	$i-=1;
}
	
	// calculate mean
	
  $air_mean->co = $co_mean/10;
  $air_mean->no = $no_max_mean/10;
  $air_mean->no2 = $no2_max_mean/10;
  $air_mean->o3 = $o3_mean/10;
  $air_mean->so2 = $so2_mean/10;
  $air_mean->loca_id=$location->Loc_id;
  $air_mean->pm2_5 = $pm2_5_mean/10;
  $air_mean->pm10 = $pm10_mean/10;
  $air_mean->nh3 = $nh3_mean/10;
  
  
   // Create mean
  $air_mean->create();
  
	// calculate median
	$air_median->co=($weathers_arr[$num-6]['co']+$weathers_arr[$num-5]['co'])/2;
	$air_median->no =($weathers_arr[$num-6]['no']+$weathers_arr[$num-5]['no'])/2;
	$air_median->no2=($weathers_arr[$num-6]['no2']+$weathers_arr[$num-5]['no2'])/2;
	 $air_median->o3 =($weathers_arr[$num-6]['o3']+$weathers_arr[$num-5]['o3'])/2;
	 $air_median->so2=($weathers_arr[$num-6]['so2']+$weathers_arr[$num-5]['so2'])/2;
	 $air_median->pm2_5=($weathers_arr[$num-6]['pm2_5']+$weathers_arr[$num-5]['pm2_5'])/2;
	 $air_median->pm10=($weathers_arr[$num-6]['pm10']+$weathers_arr[$num-5]['pm10'])/2;
	 $air_median->nh3=($weathers_arr[$num-6]['nh3']+$weathers_arr[$num-5]['nh3'])/2;
	$air_median->loca_id=$location->Loc_id;
	// Create median
	 $air_median->create();
	 
      echo json_encode(
      array('message' => 'data has been inserted')
	  );
  }
  else{
	  echo json_encode(
      array('message' => 'Not Enough data')
	  );
  }
  

