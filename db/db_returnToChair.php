<?php
$conn = mysqli_connect('localhost', 'root', '', 'efs');
require "config.php";
session_start();
$annualyear = $_SESSION['ay'];
$department =$_SESSION['college'];
$notes =$_POST['notes'];
$dean_status="Revision";

if($conn==true){
	
		 $update = "UPDATE mustattendremarks SET dean_status='$dean_status', dean_note='$notes' where annualyear='$annualyear' AND department='$department'";
         mysqli_query($conn,$update);
         header("Location: ../maListDean.php");
	
}else{
	echo "No Connection";
}


?>