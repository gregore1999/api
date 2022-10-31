<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Weather.php';
  include_once '../models/location.php';
  include_once '../models/mean.php';
  include_once '../models/median.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate objects
  $weather = new Weather($db);
  $location = new Location($db);
  $mean = new Mean($db);
  $median = new Median($db);

  if(isset($_GET['City'])){
		$city_n = $_GET['City'];
		// Get raw weather data with city name
		$api_data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city_n."&appid=94a9ca9f85b08f12596da8b2d4335c9f");
		$data = json_decode( $api_data,true);
		$location->City = $city_n;
		$location->longit = $data['coord']['lon'];
	  $location->lat = $data['coord']['lat'];
  }else if(isset($_GET['lat'])&&isset($_GET['longit'])){
		$lat = $_GET['lat'] ;
		$longit= $_GET['longit'];
		// Get raw weather data with lat and lon
		$api_data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$longit."&appid=94a9ca9f85b08f12596da8b2d4335c9f");
		$data = json_decode( $api_data,true);
	  $location->longit = $longit;
	  $location->lat = $lat;
	  $location->City= $data['name'];
  }
  
	$citybool=isset($_GET['City']);
	$longitbool=isset($_GET['longit']);
	$latbool=isset($_GET['lat']);
	
	 
	 
  if(!($citybool||$latbool||$longitbool) || (!$latbool&&$longitbool) || ($latbool&&!$longitbool) ){
		die();
  }

	$result_loc = $location->read();
	$num1 = $result_loc->rowCount();

	if($num1==0){
		$location->create(); 
	}
	$location->get_single();
 

  $weather->temp = $data['main']['temp'];
  $weather->temp_max = $data['main']['temp_max'];
  $weather->temp_min = $data['main']['temp_min'];
  $weather->humidity = $data['main']['humidity'];
  $weather->feels_like = $data['main']['feels_like'];
  $weather->conditions = $data['weather'][0]['main'];
  $weather->loca_id = $location->Loc_id;
  $weather->sunrise = (((($data['sys']['sunrise']%31556926)%2629743)%604800)%86400);
  $weather->sunset = (((($data['sys']['sunset']%31556926)%2629743)%604800)%86400);
  

  // Create weather
  $weather->create();
   
	
	//weather query
  $result = $weather->read();
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
        'id' => $w_id,
 		'temp' => $temp,
 		'temp_min' => $temp_min,
 		'temp_max' => $temp_max,
 		'humidity' => $humidity,
 		'feels_like' => $feels_like,
 		'Date' => $Date
      );

      // Push to weather_arr
      array_push($weathers_arr, $weather_item);
     
    }
$i = ($num-1);
$temp_mean=0;
$temp_max_mean=0;
$feels_like_mean=0;
$humidity_mean=0;
$temp_min_mean=0;
// sum the last 10 data
while($i>=$num-10){
	$temp_mean=$temp_mean+$weathers_arr[$i]['temp'];
	$temp_max_mean+=$weathers_arr[$i]['temp_max'];
	$feels_like_mean+=$weathers_arr[$i]['feels_like'];
	$humidity_mean+=$weathers_arr[$i]['humidity'];
	$temp_min_mean+=$weathers_arr[$i]['temp_min'];
	$i-=1;
}
	
	// calculate mean
	
  $mean->temp = $temp_mean/10;
  $mean->temp_max = $temp_max_mean/10;
  $mean->temp_min = $temp_min_mean/10;
  $mean->humidity = $humidity_mean/10;
  $mean->feels_like = $feels_like_mean/10;
  $mean->loca_id=$location->Loc_id;
  
   // Create mean
  $mean->create();
  
	// calculate median
	$median->temp=($weathers_arr[$num-6]['temp']+$weathers_arr[$num-5]['temp'])/2;
	$median->temp_max =($weathers_arr[$num-6]['temp_max']+$weathers_arr[$num-5]['temp_max'])/2;
	$median->feels_like=($weathers_arr[$num-6]['feels_like']+$weathers_arr[$num-5]['feels_like'])/2;
	 $median->humidity =($weathers_arr[$num-6]['humidity']+$weathers_arr[$num-5]['humidity'])/2;
	 $median->temp_min=($weathers_arr[$num-6]['temp_min']+$weathers_arr[$num-5]['temp_min'])/2;
	$median->loca_id=$location->Loc_id;
	// Create median
	 $median->create();
	 
      echo json_encode(
      array('message' => 'data has been inserted')
	  );
  }
  else{
	  echo json_encode(
      array('message' => 'Not Enough data')
	  );
  }
  

