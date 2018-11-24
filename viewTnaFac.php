<?php
session_start();

$tnaid = $_POST['tnaid'];
$_SESSION['tnaid']=$tnaid;

header('Location:tnaView.php');

?>