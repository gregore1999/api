<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/mean.php';
  include_once '../models/median.php';
  include_once '../models/location.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate objects
  $mean = new Mean($db);
  $median = new Median($db);
  $location = new Location($db);
  
if(isset($_GET['City'])){
	  $location->City = $_GET['City'];
	  $location->get_single();
  }else if(isset($_GET['lat'])&&isset($_GET['longit'])){
		$location->lat = $_GET['lat'] ;
		$location->longit= $_GET['longit'];
	  $location->get_single_coord();
  }

  // Get information from mean table
  $mean->loca_id  =  $location->Loc_id;
  $mean->read();
  //$median->
  // Create array
  $weathers_arr=array();
  
  $weather_item = array(
  'MEAN' => '',
 	'temp (kelvin)' => $mean->temp,
		'temp (celsius)' => $mean->temp - 273.15,
		'temp (Fahrenheit)' => (($mean->temp- 273.15)*1.8)+32,
 		'temp_min (kelvin)' => $mean->temp_min,
		'temp_min (celsius)' => $mean->temp_min- 273.15,
		'temp_min (Fahrenheit)' => (($mean->temp_min- 273.15)*1.8)+32,
 		'temp_max (kelvin)' => $mean->temp_max,
		'temp_max (celsius)' => $mean->temp_max- 273.15,
		'temp_max (Fahrenheit)' => (($mean->temp_max- 273.15)*1.8)+32,
 		'humidity' => $mean->humidity,
 		'feels_like (kelvin)' => $mean->feels_like,
		'feels_like (celsius)' => $mean->feels_like- 273.15,
		'feels_like (Fahrenheit)' => (($mean->feels_like- 273.15)*1.8)+32,
 		'Date' => $mean->Date,
  );
//push to weathers_arr
array_push($weathers_arr, $weather_item);

  // Get information from median table
  $median->loca_id  =  $location->Loc_id;
  $median->read();
  

  // Create array
  $weather_item = array(
  'MEDIAN' => '',
 			'temp (kelvin)' => $median->temp,
		'temp (celsius)' => $median->temp - 273.15,
		'temp (Fahrenheit)' => (($median->temp- 273.15)*1.8)+32,
 		'temp_min (kelvin)' => $median->temp_min,
		'temp_min (celsius)' => $median->temp_min- 273.15,
		'temp_min (Fahrenheit)' => (($median->temp_min- 273.15)*1.8)+32,
 		'temp_max (kelvin)' => $median->temp_max,
		'temp_max (celsius)' => $median->temp_max- 273.15,
		'temp_max (Fahrenheit)' => (($median->temp_max- 273.15)*1.8)+32,
 		'humidity' => $median->humidity,
 		'feels_like (kelvin)' => $median->feels_like,
		'feels_like (celsius)' => $median->feels_like- 273.15,
		'feels_like (Fahrenheit)' => (($median->feels_like- 273.15)*1.8)+32,
 		'Date' => $median->Date,
  );
  //push to weathers_arr
  array_push($weathers_arr, $weather_item);
  // Make JSON
  print_r(json_encode($weathers_arr));