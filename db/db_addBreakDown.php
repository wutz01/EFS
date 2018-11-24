<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";


$masid = $_POST['masid'];
$numDean = $_POST['numDean'];
$numChair = $_POST['numChair'];
$numFaculty = $_POST['numFaculty'];
$hotelDean = $_POST['hotelDean'];
$hotelChair = $_POST['hotelChair'];
$hotelFaculty = $_POST['hotelFaculty'];
$diemDean = $_POST['diemDean'];
$diemChair = $_POST['diemChair'];
$diemDean = $_POST['diemFaculty'];
$feeReg = $_POST['feeReg'];
$feeFood = $_POST['feeFood'];
$feeTrans = $_POST['feeTrans'];




if($conn==true){
	if(($masid!=null)&&($numDean!=null)&&($numChair!=null)&&($numFaculty!=null)&&($hotelDean!=null)&&($hotelChair!=null)&&($hotelFaculty!=null)&&($diemDean!=null)&&($diemChair!=null)&&($diemFaculty!=null)&&($feeReg!=null)&&($feeFood!=null)&&($feeTrans!=null)){

        $inserts = "Insert into massbreakdown values ('','$masid','$numDean','$numChair','$numFaculty','$hotelDean','$hotelChair','$hotelFaculty','$diemDean','$diemChair','$diemFaculty','$feeReg','$feeFood','$feeTrans')";
        mysql_query($inserts,$conn);
             
	}else{
		// echo "Do not leave blank form";
		$notification="Dont leave form blank";
	}
}else{
	echo "No Connection";
}
$out='{"notification":"'.$notification.'"}';
echo $out;
?>