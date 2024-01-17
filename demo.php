<?php 
   //print_r($_POST);
   //content type: text/html; charset=UTF-8
   //http code: 200
   //Array ( [message] => Hello World [name] => Anand )

   $msg = $_POST['message'];
   $name = $_POST['name'];

   

   echo $msg . ' ' . $name;
?>