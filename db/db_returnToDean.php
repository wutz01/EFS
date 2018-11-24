<?php

require "config.php";
session_start();
$annualyear = $_SESSION['ay'];
$department =$_SESSION['departments'];
$notes =$_POST['notes'];
$status="Revision";
$conn = mysqli_connect('localhost', 'root', '', 'efs');

if($conn==true){
	
		 $update = "UPDATE mustattendremarks SET vp_status='$status', vp_note='$notes' where annualyear='$annualyear' AND department='$department'";
         mysqli_query($conn, $update);
         header("Location: ../maListVpar.php");
	
}else{
	echo "No Connection";
}


?>