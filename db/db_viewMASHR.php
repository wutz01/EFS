<?php




session_start();

$annualyear = $_POST['annualyear'];

$department =$_POST['department'];



$_SESSION['ay']=$annualyear;

$_SESSION['departments']=$department;




header('Location: ../mustAttendHR.php');

?>