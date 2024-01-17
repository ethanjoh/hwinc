<?php
  // Here is the data we will be sending to the service
  $some_data = array(
    'message' => 'Hello World', 
    'name' => 'Arnold'
  );  

  $ch = curl_init();
  // You can also set the URL you want to communicate with by doing this:
  // $ch = curl_init('http://hwinc.co.kr/echoservice');

  // We POST the data
  curl_setopt($ch, CURLOPT_POST, 1);
  // Set the url path we want to call
  curl_setopt($ch, CURLOPT_URL, 'http://hwinc.co.kr/demo.php');  
  // Make it so the data coming back is put into a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // Insert the data
  curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);

  // You can also bunch the above commands into an array if you choose using: curl_setopt_array

  // Send the request
  $result = curl_exec($ch);

  // Free up the resources $ch is using
  curl_close($ch);

  //$r =  json_decode($result);
  print_r($result);
?>