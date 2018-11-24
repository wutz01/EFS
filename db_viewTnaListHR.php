<?php session_start();

require "config.php";

$academicyear= $_POST['academicyear'];
$deparment= $_POST['department'];


$_SESSION['academicyear']=$academicyear;
$_SESSION['departments']=$deparment;

header('Location: ../tnaViewHr.php');
?>