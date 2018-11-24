<?php

require "config.php";
session_start();
$academicyear= $_POST['academicyear'];
$deparment= $_POST['department'];


$_SESSION['academicyear']=$academicyear;
$_SESSION['departments']=$deparment;

header('Location: ../tnaViewVpar.php');
?>