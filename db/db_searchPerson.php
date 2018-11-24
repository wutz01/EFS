<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

$name = $_POST["name"];
// $name = "jpcruz@firstasia.edu.ph";


if($conn==true){
	if($name!=null){

            $result2 = mysql_query("SELECT * FROM profile WHERE email ='$name'");
            $row= mysql_fetch_assoc($result2);
             $num_rows2 = mysql_num_rows($result2);
             if($num_rows2>0){
             	$notification=$row['firstname']." ". $row['lastname'];
             }else{
                   $notification="Email address does not exist";
             }
        
            // header('Location: ../maCreate.php');
           
	}else{
		echo "Do not leave blank form";
		$notification="Dont leave form blank";
	}
}else{
	echo "No Connection";
}
$out='{"notification":"'.$notification.'"}';
echo $out;
?>