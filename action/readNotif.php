<?php

//include('../db/config.php');

$conn = mysqli_connect('localhost', 'root', '', 'efsdpv2');

$id = $_GET['id'];
$link = $_GET['link'];

$read = mysqli_query($conn, "UPDATE notif SET has_read = 1 WHERE id = '$id' ");
header("location: ../$link");