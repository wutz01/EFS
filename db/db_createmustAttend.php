<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

$email = $_POST["useremail"];
$ay = $_POST["ay"];
$date_created = $_POST["datecreated"];
$school = $_POST["schools"];
$department = $_POST["departments"];
$title =  $_POST["title"];
$category = $_POST["category"];
$sponsor = $_POST["sponsor"];
$dates = $_POST["dates"];
$days = $_POST["days"];
$venue = $_POST["venue"];
$numofheads = $_POST["person"];
$numoffaculty = $_POST["pax"];
$estimated_budget = $_POST["budget"];


$chair_remarks = "New";
$dean_note = "New";
$vp_note = "New";
$hr_note = "New";
$dean_remarks = "New";
$vp_remarks = "New";
$hr_remarks= "New";

if($conn==true){
	if(($title!=null)&&($category!=null)&&($sponsor!=null)&&($dates!=null)&&($days!=null)&&($venue!=null)&&($numofheads!=null)&&($numoffaculty!=null)&&($estimated_budget!=null)){

		$inserts = "Insert into offcampus values ('','$email','$ay','$date_created','$department','$school','$title','$category','$sponsor','$dates','$days','$venue','$numofheads','$numoffaculty','$estimated_budget')";
            mysql_query($inserts,$conn);

            $result2 = mysql_query("SELECT * FROM mustattendremarks WHERE annualyear ='$ay' AND department='$department'");
             $num_rows2 = mysql_num_rows($result2);
                    
             if($num_rows2<=0){
             	 $inserts1 = "Insert into mustattendremarks values ('','$ay','$date_created','$department','$dean_remarks','$dean_note','$vp_remarks','$vp_note','$hr_remarks','$hr_note')";
            	mysql_query($inserts1,$conn);
             }else{

             }
        
            // header('Location: ../maCreate.php');
            $notification="Successfully submit must attend seminar";
	}else{
		echo "Do not leave blank form";
		$notification="Dont leave form blank";
	}
}else{
	echo "No Connection";
}
$out='{"notification":"'.$notification.'"}';
echo $out;
?>