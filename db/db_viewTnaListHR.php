<?php

require "config.php";
session_start();
$academicyear= $_POST['academic_year'];
$deparment= $_POST['department'];


$_SESSION['academic_year']=$academicyear;
$_SESSION['departments']=$deparment;

header('Location: ../tnaViewHr.php');
?>