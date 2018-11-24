<?php session_start();
if($_SESSION['user']){
	$logUser = $_SESSION['user'];
	$email = $_SESSION['username'];
	$lastname = $_SESSION['lastname'];
	$firstname = $_SESSION['firstname'];
	$middlename = $_SESSION['middlename'];
	$college = $_SESSION['college'];
	$school = $_SESSION['school'];
	$acad = $_SESSION['academicyear'];
	$ay = $_SESSION['academicyear'];
}else{
	header("location: action/logout.php");
}