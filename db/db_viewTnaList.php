<?php

require "config.php";
session_start();
$academicyear= $_POST['academicyear'];


$_SESSION['academicyear']=$academicyear;

header('Location: ../tnaViewDean.php');
?>