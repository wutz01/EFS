<?php

require "config.php";
session_start();
$annualyear = $_POST['ay'];
$department =$_POST['department'];

$dean_note = "Approved";


if($conn==true){
	
		 $update = "UPDATE tnalist SET dean_note='$dean_note' where academicyear='$annualyear' AND department='$department'";
         mysql_query($update,$conn);
         header("Location: ../tnaDean.php");
         
	
}else{
	echo "No Connection";
}


?>