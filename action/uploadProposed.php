<?php
$conn = mysqli_connect('localhost', 'root', '', 'efsdpv2');

include('../db/config.php');

$reqid = $_POST['reqid'];
$actual = $_POST['actual'];
$filenames = array();
$i = 0;

foreach($_FILES['docs']['name'] as $filename){
	$filenames[] = $filename;
	$targetPath = "../uploads/".$filename;
	move_uploaded_file($_FILES['docs']['tmp_name'][$i], $targetPath);
	$i++;
}


$docs = implode(';', $filenames);

$getMas = mysqli_query($conn, "SELECT * FROM sem_emp WHERE id = '$reqid' ");
while($rows = mysqli_fetch_assoc($getMas)){
    $masid = $rows['sem_id'];
}

$findmas = mysqli_query($conn, "SELECT mas_id FROM mas_proposed WHERE mas_id = '$masid' ");
if(mysqli_num_rows($findmas)!=0){
	$q = mysqli_query($conn, "UPDATE mas_proposed SET docs='$docs',actual='$actual' WHERE mas_id = '$masid' ");
}else{
	$q = mysqli_query($conn, "UPDATE othersem_proposed SET docs='$docs',actual='$actual' WHERE othersem_id = '$masid' ");
}

$checkyes = mysqli_query($conn, "UPDATE sem_emp SET attended = 'yes' WHERE id = '$reqid' ");


if($q){
	echo "Success";
}
