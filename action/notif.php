<?php

include('../db/config.php');

$lastCount = $_POST['lastCount'];


$result = mysql_query("SELECT * FROM account");
// $qrow = mysql_num_rows($result);

$lastCount =  mysql_num_rows($result);

print_r($lastCount);
?>
