<?php

require "config.php";
session_start();
$id = $_POST['tnaid'];


$_SESSION['tnaid']=$id;

header('Location: ../tnaView.php');
?>