<?php

require "config.php";
session_start();
$annualyear = $_POST['annual'];
$department =$_SESSION['college'];

$hr_status="Approved";


if($conn==true){
	
		 $update = "UPDATE mustattendremarks SET hr_status='$hr_status' where annualyear='$annualyear' AND department='$department'";
         mysql_query($update,$conn);
         header("Location: ../maListDean.php");
         echo $annualyear;
	
}else{
	echo "No Connection";
}


?>