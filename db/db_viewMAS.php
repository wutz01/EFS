<?php

require "config.php";
session_start();
$annualyear = $_POST['annualyear'];
$department =$_SESSION['college'];

$_SESSION['ay']=$annualyear;

header('Location: ../mustAttendDean.php');
?>