<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Weather.php';
    include_once '../models/location.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog weather object
  $weather = new Weather($db);
$location = new Location($db);
  // Get ID
  if(isset($_GET['City'])){
	  $location->City = $_GET['City'];
	  $location->get_single();
  }else if(isset($_GET['lat'])&&isset($_GET['longit'])){
		$location->lat = $_GET['lat'] ;
		$location->longit= $_GET['longit'];
	  $location->get_single_coord();
  }

  
  $weather->loca_id  =  $location->Loc_id;
  
  $weather->Date = isset($_GET['date']) ? $_GET['date'] : die();

  // Get single weather
  $weather->read_single();



  // Create array
  $weather_arr = array(
		
 		'temp (kelvin)' => $weather->temp,
		'temp (celsius)' => $weather->temp - 273.15,
		'temp (Fahrenheit)' => (($weather->temp- 273.15)*1.8)+32,
 		'temp_min (kelvin)' => $weather->temp_min,
		'temp_min (celsius)' => $weather->temp_min- 273.15,
		'temp_min (Fahrenheit)' => (($weather->temp_min- 273.15)*1.8)+32,
 		'temp_max (kelvin)' => $weather->temp_max,
		'temp_max (celsius)' => $weather->temp_max- 273.15,
		'temp_max (Fahrenheit)' => (($weather->temp_max- 273.15)*1.8)+32,
 		'humidity' => $weather->humidity,
 		'feels_like (kelvin)' => $weather->feels_like,
		'feels_like (celsius)' => $weather->feels_like- 273.15,
		'feels_like (Fahrenheit)' => (($weather->feels_like- 273.15)*1.8)+32,
 		'Date' => $weather->Date,
		'conditions'=>$weather->conditions,
		'sunrise'=>intdiv($weather->sunrise , 3600 )."h ". intdiv(($weather->sunrise % 3600 ), 60). 'm ' .(($weather->sunrise % 3600)%60) .'s',
		'sunset'=>  intdiv($weather->sunset , 3600 )."h ". intdiv(($weather->sunset % 3600 ), 60). 'm ' .(($weather->sunset % 3600)%60) .'s'
		
  );

  // Make JSON
  print_r(json_encode($weather_arr));