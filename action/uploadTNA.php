<?php

include('../db/config.php');

$email = $_POST['email'];
$jobid = $_POST['jobrole'];
$filenames = array();
$i = 0;

foreach($_FILES['docs']['name'] as $filename){
	$filenames[] = $filename;
	$targetPath = "../uploads/".$filename;
	move_uploaded_file($_FILES['docs']['tmp_name'][$i], $targetPath);
	$i++;
}


$docs = implode(';', $filenames);

$q = mysql_query("UPDATE tna SET evidence='$docs' WHERE email = '$email' AND id = '$jobid' ");

if($q){
	echo "Success";
}
