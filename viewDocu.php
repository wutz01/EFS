<?php
require "db/config.php";

$id=$_POST['jobids'];

$result = mysql_query("SELECT * FROM tna_docu where jobid='$id'");
        while($row = mysql_fetch_array($result)){
        	echo '<img src="docuimage/';
        	echo $row['docu'];
        	echo '"  style="width:50%;height:600px;">';
        }
?>