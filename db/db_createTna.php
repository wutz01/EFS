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

$evidence = " ";
$faculty_remarks = "New";
$faculty_note="New";
$dean_note = "New";
$dean_remarks = "New";


if($conn==true){
	if(($title!=null)&&($importance!=null)&&($ability!=null)&&($competence!=null)&&($devplan!=null)&&($email!=null)&&($position!=null)&&($department!=null)&&($ay!=null)&&($datecreated!=null)){

             
                  $inserts = "Insert into tna values ('','$email','$datecreated','$department','$ay','$title','$importance','$ability','$competence','$devplan','$evidence')";
            mysql_query($inserts,$conn);
             

            $notification="1";
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