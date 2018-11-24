<?php

date_default_timezone_set('Asia/Taipei');

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'efs';
$errorMsg = 'Connection failed.';

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno())
{
	echo $errorMsg.' '.mysqli_connect_error();
}

?>
