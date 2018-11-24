<?php
$conn = mysqli_connect('localhost', 'root', '', 'efs');
require "config.php";
session_start();
$annualyear = $_SESSION['ay'];
$department =$_SESSION['college'];
$notes ="New";
$dean_status="Approved";
$vp_status="Resend";
$vp_notes="New";

if($conn==true){

		 $result2 = mysqli_query($conn, "SELECT * FROM mustattendremarks WHERE annualyear ='$annualyear' AND department='$department'");
         $row= mysqli_fetch_assoc($result2);

         if($row['vp_status']=="New"){
         	 $update = "UPDATE mustattendremarks SET dean_status='$dean_status', dean_note='$notes' where annualyear='$annualyear' AND department='$department'";
         mysqli_query($conn, $update);
         }else{
         	$update = "UPDATE mustattendremarks SET dean_status='$dean_status', dean_note='$notes', vp_status='$vp_status', vp_note='$vp_notes' where annualyear='$annualyear' AND department='$department'";
         	mysqli_query($conn, $update);
         }
	
		
         header("Location: ../maListDean.php");
	
}else{
	echo "No Connection";
}


?>