<?php 

$error='';
$weather1='';
$weather2='';
$weather3='';
$weather4='';
$weather5='';
if(array_key_exists('submit',$_GET)){

    if (!$_GET['City']&&(!$_GET['lat']&&!$_GET['longit']||$_GET['lat']&&!$_GET['longit']||!$_GET['lat']&&$_GET['longit'])) {
	$error = "Your input field is empty";
	}
	if($_GET['City']){
     $urlContents = file_get_contents("http://localhost/api/api/mean-median.php?City=".$_GET['City']);
         
        
	}
	
		if($_GET['lat']&&$_GET['longit']){
			
     $urlContents = file_get_contents("http://localhost/api/api/mean-median.php?lat=".$_GET['lat']."&longit=".$_GET['longit']);
         
       
	}
		 $weatherArray = json_decode($urlContents, true);
	$i=0;
     $weather1 ="<b> Mean </b></br><b> temp (kelvin) </b> ".$weatherArray[$i]['temp (kelvin)']."</br>
	<b> temp (celsius) </b> ".$weatherArray[$i]['temp (celsius)']."</br>
	   <b> temp (Fahrenheit) </b> ".$weatherArray[$i]['temp (Fahrenheit)']."</br>
	   <b> temp_min (kelvin) </b> ".$weatherArray[$i]['temp_min (kelvin)']."</br>
		 <b> temp_min (celsius) </b> ".$weatherArray[$i]['temp_min (celsius)']."</br>
		  <b> temp_min (Fahrenheit) </b> ".$weatherArray[$i]['temp_min (Fahrenheit)']."</br>
		   <b> temp_max (kelvin) </b> ".$weatherArray[$i]['temp_max (kelvin)']."</br>
		    <b> temp_max (celsius) </b> ".$weatherArray[$i]['temp_max (celsius)']."</br>
			 <b> temp_max (Fahrenheit) </b> ".$weatherArray[$i]['temp_max (Fahrenheit)']."</br>
			  <b> humidity </b> ".$weatherArray[$i]['humidity']."</br>
			   <b> feels_like (kelvin) </b> ".$weatherArray[$i]['temp (kelvin)']."</br>
			    <b> feels_like (celsius) </b> ".$weatherArray[$i]['temp (celsius)']."</br>
				 <b> feels_like (Fahrenheit) </b> ".$weatherArray[$i]['temp (Fahrenheit)']."</br>";
					$i=1;
					     $weather2 ="<b> Median </b></br><b> temp (kelvin) </b> ".$weatherArray[$i]['temp (kelvin)']."</br>
	<b> temp (celsius) </b> ".$weatherArray[$i]['temp (celsius)']."</br>
	   <b> temp (Fahrenheit) </b> ".$weatherArray[$i]['temp (Fahrenheit)']."</br>
	   <b> temp_min (kelvin) </b> ".$weatherArray[$i]['temp_min (kelvin)']."</br>
		 <b> temp_min (celsius) </b> ".$weatherArray[$i]['temp_min (celsius)']."</br>
		  <b> temp_min (Fahrenheit) </b> ".$weatherArray[$i]['temp_min (Fahrenheit)']."</br>
		   <b> temp_max (kelvin) </b> ".$weatherArray[$i]['temp_max (kelvin)']."</br>
		    <b> temp_max (celsius) </b> ".$weatherArray[$i]['temp_max (celsius)']."</br>
			 <b> temp_max (Fahrenheit) </b> ".$weatherArray[$i]['temp_max (Fahrenheit)']."</br>
			  <b> humidity </b> ".$weatherArray[$i]['humidity']."</br>
			   <b> feels_like (kelvin) </b> ".$weatherArray[$i]['temp (kelvin)']."</br>
			    <b> feels_like (celsius) </b> ".$weatherArray[$i]['temp (celsius)']."</br>
				 <b> feels_like (Fahrenheit) </b> ".$weatherArray[$i]['temp (Fahrenheit)']."</br>";
					
					 
         
    
	 }
	 ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
 
  <title>Weather App</title>
  
  
  <style>
  html { 
          background: url() no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
         
          body {
               
              background: none;
               
          }
           
          .container {
               
              text-align: center;
              margin-top: 100px;
              width: 450px;
               
          }
           
          input {
               
              margin: 20px 0;
               
          }
           
          #weather {
               
              margin-top:15px;
			  
			  
			  }
			  div.output{
				  
  margin: auto;
  
  
  column-count: 2;
			  }  
		  
          }
  </style>
</head>
<body>
    <div class="container">
       
          <h1>Last 10 days mean and median</h1>
           
           
           
          <form method="get" action="http://localhost/api/mean-median-show.php">
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="City" id="city" placeholder="Eg. London, Tokyo" value = "">
	OR
	 <input type="text" class="form-control" name="lat" id="city" placeholder="Latitude Eg. 40.6403" value = "">
	  <input type="text" class="form-control" name="longit" id="city" placeholder="Longitude Eg. 22.9439" value = "">
  </fieldset>
   
  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  
</form>
<a href="history.php" class="btn btn-primary">Weather history</a>
       <a href="webpage.php" class="btn btn-primary">5 days forecast</a>
          <div id="weather"></div>
      </div>
	  <div class="output">
	  
	  
	  
 <?php
 
 if($weather1){
	 echo '<div  class="alert alert-danger" role"alert"class="output">
	  '.$weather1.'
	  </div>';
	  echo '<div class="alert alert-danger" role"alert">
	  '.$weather2.'
	  </div>';
	 
 }
    if($error){
 echo '<div class="alert alert-danger" role"alert ">
	  '.$error.'
	  </div>';
	}
?>
</div>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>