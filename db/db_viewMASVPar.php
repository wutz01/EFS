<?php

require "config.php";
session_start();
$annualyear = $_POST['annualyear'];
$department =$_POST['department'];

$_SESSION['ay']=$annualyear;
$_SESSION['departments']=$department;

echo $department;
header('Location: ../mustAttendVpar.php');
?>