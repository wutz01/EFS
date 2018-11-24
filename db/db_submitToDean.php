<?php

require "config.php";
session_start();
$annualyear = $_SESSION['ay'];
$department =$_SESSION['departments'];
$notes ="New";
$vp_status="Approved";
$conn = mysqli_connect('localhost', 'root', '', 'efs');


if($conn==true){
	
		 $update = "UPDATE mustattendremarks SET vp_status='$vp_status', hr_status='$vp_status', vp_note='$notes' where annualyear='$annualyear' AND department='$department'";
         mysqli_query($conn, $update);
         header("Location: ../maListVpar.php");
	
}else{
	echo "No Connection";
}


?>