<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";


$email =  $_POST["email"];
$position = $_POST["position"];
$department = $_POST["department"];
$ay = $_POST["ay"];
$datecreated = $_POST["datecreated"];

$faculty_remarks = "New";
$faculty_note="New";
$dean_note = "New";
$dean_remarks = "New";


if($conn==true){
	      $result2 = mysql_query("SELECT * FROM tnalist WHERE email='$email' AND department='$department' AND academicyear='$ay'");
             $row = mysql_fetch_array($result2);
             $num_rows2 = mysql_num_rows($result2);
             
             if($num_rows2<=0){
                  $inserts = "Insert into tnalist values ('','$email','$datecreated','$department','$ay','$faculty_remarks','$faculty_note','$dean_note')";
                  
                  mysql_query($inserts,$conn);

                  $result3 = mysql_query("SELECT * FROM tnafolder WHERE academicyear='$ay' AND department='$department'");
                  $num_rows3 = mysql_num_rows($result3);
                  if($num_rows3<=0){
                         $inserts1 = "Insert into tnafolder values ('','$ay','$datecreated','$department')";
                         mysql_query($inserts1,$conn);
                  }

                  
             }else{
           
             }

            $notification="1";
	
}else{
	echo "No Connection";
}
$out='{"notification":"'.$notification.'"}';
echo $out;
?>