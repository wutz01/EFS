<?php

include('../db/config.php');

$action = $_GET['action'];
$result = array();

switch($action){
	case 'inhouse_attendance':
	$email = $_GET['email'];
	$value = $_GET['value'];
	checkAttendance($email,$value);
	break;
	case 'maintenance_change_travel':
	$value = $_GET['value'];
	changeTravel($value);
	break;
	case 'profile_changepass':
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	changePass($email,$pass);
	break;
}

function checkAttendance($email, $value){
	$q = mysql_query("UPDATE hr_inhouse_emp SET attended = '$value' WHERE emp_email = '$email' ");
	if($q){
		echo "ok";
	}else{
		echo "WTF";
	}
}

function changePass($email, $pass){
	$q = mysql_query("UPDATE account SET password = '$pass' WHERE email = '$email' ");
	if($q){
		echo "ok";
	}else{
		echo "WTF";
	}
}

function changeTravel($value){
	$deanHotel = $value['deanHotel'];
	$chairHotel = $value['chairHotel'];
	$facHotel = $value['facultyHotel'];

	$deanDiem = $value['deanDiem'];
	$chairDiem = $value['chairDiem'];
	$facDiem = $value['facultyDiem'];

	$dH = mysql_query("UPDATE travel_guide SET amount = '$deanHotel' WHERE pos = 'dean' AND fee_type = 'hotel' ");
	$cH = mysql_query("UPDATE travel_guide SET amount = '$chairHotel' WHERE pos = 'chair' AND fee_type = 'hotel' ");
	$fH = mysql_query("UPDATE travel_guide SET amount = '$facHotel' WHERE pos = 'faculty' AND fee_type = 'hotel' ");

	$dH = mysql_query("UPDATE travel_guide SET amount = '$deanDiem' WHERE pos = 'dean' AND fee_type = 'diem' ");
	$cH = mysql_query("UPDATE travel_guide SET amount = '$chairDiem' WHERE pos = 'chair' AND fee_type = 'diem' ");
	$fH = mysql_query("UPDATE travel_guide SET amount = '$facDiem' WHERE pos = 'faculty' AND fee_type = 'diem' ");

	// print_r($value);
	echo '<div class="alert alert-success">Saved Success!</div>';
}