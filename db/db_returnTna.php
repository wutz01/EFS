<?php

require "config.php";
session_start();
$id = $_SESSION['tnaid'];
$remarks =$_POST['returns'];
$faculty_remarks ="Revision";



if($conn==true){
	
		 $update = "UPDATE tnalist SET faculty_note='$faculty_remarks', faculty_remarks='$remarks' where id='$id'";
         mysql_query($update,$conn);
         header("Location: ../tnaFac.php");
         echo $annualyear;
	
}else{
	echo "No Connection";
}


?>