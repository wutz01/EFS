<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

$name = $_POST["name"];
// $name = "jpcruz@firstasia.edu.ph";


if($conn==true){
	if($name!=null){

            $result2 = mysql_query("SELECT * FROM profile WHERE email ='$name'");

                  $out = "[";
                  while($row= mysql_fetch_assoc($result2)){
                              if ($out != "[") {$out .= ",";}
                              $out .= '{"id":"'. $row['id']. '",'; 
                              $out .= '"email":"'. $row['email']. '",';
                              $out .= '"lastname":"'. $row['lastname']. '",';
                              $out .= '"firstname":"'. $row['firstname']. '",';
                              $out .= '"middlename":"'. $row['middlename']. '",';
                              $out .= '"designation":"'. $row['designation']. '",';
                              $out .= '"college":"'. $row['college']. '",';
                              $out .= '"school":"'. $row['school']. '"}'; 


             	}
                  $out .="]";
           
            // header('Location: ../maCreate.php');
           
	}else{
		echo "Do not leave blank form";
		$notification="Dont leave form blank";
	}
}else{
	echo "No Connection";
}

echo $out;
?>