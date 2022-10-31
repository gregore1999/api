<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Weather.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

 
 
    // weather array
    $weathers_arr = array();
 
// Get weather data from api

 if(isset($_GET['City'])){
		$city_n = $_GET['City'];
		// Get raw weather data with city name
		$api_data = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?q=".$city_n."&appid=94a9ca9f85b08f12596da8b2d4335c9f");
		 $data = json_decode( $api_data,true);
  }else if(isset($_GET['lat'])&&isset($_GET['longit'])){
		$lat = $_GET['lat'] ;
		$longit= $_GET['longit'];
		// Get raw weather data with lat and lon
		$api_data = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$longit."&appid=94a9ca9f85b08f12596da8b2d4335c9f");
		$data = json_decode( $api_data,true);
	
  }




//take weather informations for each day
  for($i=0;$i<$data['cnt']-1; $i+=8){
 $data['city']['sunrise']=((($data['city']['sunrise']%31556926)%2629743)%604800)%86400;
  $data['city']['sunset']=((($data['city']['sunset']%31556926)%2629743)%604800)%86400;
      $weather_item = array(
   
 		'temp (kelvin)' => $data['list'][$i]['main']['temp'],
		'temp (celsius)' => $data['list'][$i]['main']['temp']- 273.15,
		'temp (Fahrenheit)' => (($data['list'][$i]['main']['temp']- 273.15)*1.8)+32,
 		'temp_min (kelvin)' => $data['list'][$i]['main']['temp_min'],
		'temp_min (celsius)' => $data['list'][$i]['main']['temp_min']- 273.15,
		'temp_min (Fahrenheit)' => (($data['list'][$i]['main']['temp_min']- 273.15)*1.8)+32,
 		'temp_max (kelvin)' => $data['list'][$i]['main']['temp_max'],
		'temp_max (celsius)' => $data['list'][$i]['main']['temp_max']- 273.15,
		'temp_max (Fahrenheit)' => (($data['list'][$i]['main']['temp_max']- 273.15)*1.8)+32,
 		'humidity' =>$data['list'][$i]['main']['humidity'],
 		'feels_like (kelvin)' => $data['list'][$i]['main']['feels_like'],
		'feels_like (celsius)' => $data['list'][$i]['main']['feels_like']- 273.15,
		'feels_like (Fahrenheit)' => (($data['list'][$i]['main']['feels_like']- 273.15)*1.8)+32,
		'conditions' => $data['list'][$i]['weather'][0]['main'],
		'sunrise'=>intdiv($data['city']['sunrise'], 3600 )."h ". intdiv(($data['city']['sunrise'] % 3600 ), 60). 'm ' .(($data['city']['sunrise'] % 3600)%60) .'s',
		'sunset'=>  intdiv($data['city']['sunset'] , 3600 )."h ". intdiv(($data['city']['sunset'] % 3600 ), 60). 'm ' .(($data['city']['sunset'] % 3600)%60) .'s',
		'Date' => $data['list'][$i]['dt_txt']
		
      );

      // Push to weathers_arr
      array_push($weathers_arr, $weather_item);
  }
      

    // Turn to JSON & output
    echo json_encode($weathers_arr);

  
  
