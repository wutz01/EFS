<?php

require "config.php";
session_start();
$annualyear = $_SESSION['ay'];
$department =$_SESSION['departments'];
$notes =$_POST['notes'];
$status="Revision";
$conn = mysqli_connect('localhost', 'root', '', 'efs');

if($conn==true){
	
		 $update = "UPDATE mustattendremarks SET hr_status='$status' where annualyear='$annualyear' AND department='$department'";
         mysqli_query($conn, $update);
         header("Location: ../maListHr.php");
	
}else{
	echo "No Connection";
}


?>