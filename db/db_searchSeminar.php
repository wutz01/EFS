<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

$title = $_POST["title"];
// $title = "PSITE1";

// $name = "jpcruz@firstasia.edu.ph";


if($conn==true){
	if($title!=null){

            $result2 = mysql_query("SELECT * FROM mustattend WHERE title ='$title'");

                  $out = "[";
                  while($row= mysql_fetch_assoc($result2)){
                              if ($out != "[") {$out .= ",";}
                              $out .= '{"id":"'. $row['id']. '",'; 
                              $out .= '"masid":"'. $row['masid']. '",';
                              $out .= '"datecreated":"'. $row['datecreated']. '",';
                              $out .= '"academicyear":"'. $row['academicyear']. '",';
                              $out .= '"school":"'. $row['school']. '",';
                              $out .= '"department":"'. $row['department']. '",';
                              $out .= '"title":"'. $row['title']. '",';
                              $out .= '"category":"'. $row['category']. '",';
                              $out .= '"sponsor":"'. $row['sponsor']. '",';
                              $out .= '"dates":"'. $row['dates']. '",';
                              $out .= '"numdays":"'. $row['numdays']. '",';
                              $out .= '"venue":"'. $row['venue']. '",';
                              $out .= '"numperson":"'. $row['numperson']. '",';
                              $out .= '"budget":"'. $row['budget']. '"}'; 


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