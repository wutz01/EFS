<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

$title= $_POST["title"];
$importance = $_POST["importance"];
$ability = $_POST["ability"];
$competence = $_POST["competence"];
$devplan = $_POST["devplan"];
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
	if(($title!=null)&&($importance!=null)&&($ability!=null)&&($competence!=null)&&($devplan!=null)&&($email!=null)&&($position!=null)&&($department!=null)&&($ay!=null)&&($datecreated!=null)){

             $result2 = mysql_query("SELECT * FROM tna WHERE email ='$email' AND annualyear='$ay' AND job_role='$title'");
             $num_rows2 = mysql_num_rows($result2);
             if($num_rows2<=0){
                  $inserts = "Insert into tna values ('','$email','$datecreated','$department','$ay','$title','$importance','$ability','$competence','$devplan')";
            mysql_query($inserts,$conn);
             }
             else{
                   $update = "UPDATE tna SET  position_importance='$importance', ability='$ability', competency='$competence', developmentplan='$devplan' where email ='$email' AND annualyear='$ay' AND job_role='$title'";
                  mysql_query($update,$conn);
                   $update1 = "UPDATE tnalist SET  faculty_note='$faculty_note', faculty_remarks='$faculty_remarks' where email ='$email' AND academicyear='$ay'";
                  mysql_query($update1,$conn);
             }

            $notification="Successfully update Traning Needs Analysis";
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