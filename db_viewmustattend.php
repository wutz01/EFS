<?php session_start();

require "config.php";

$annualyear = $_POST['academicyear'];
$department =$_SESSION['college'];

$_SESSION['ay']=$annualyear;

header('Location: mustAttend.php');
?>