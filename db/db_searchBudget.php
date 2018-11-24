<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";

// $masid= $_POST["masid"];
$masid="mas14876041558096";
// $email= $_POST["email"];
// $usertype= $_POST["usertype"];
$usertype= "chair";
// $title = "PSITE1";

// $name = "jpcruz@firstasia.edu.ph";


if($conn==true){
	if($masid!=null){

            $result2 = mysql_query("SELECT * FROM masbreakdown WHERE masid ='$masid'");

                  $out = "[";
                  while($row= mysql_fetch_assoc($result2)){

                        if($usertype=="dean"){
                              $budget = $row['deanHotel']+$row['deanDiem']+$row['regDean']+($row['transpoDean']*2);
                        }else if($usertype=="chair"){
                              $budget = $row['chairHotel']+$row['chairDiem']+$row['regChair']+($row['transpoChair']*2);
                        }else if($usertype=="faculty"){     
                              $budget = $row['facultyHotel']+$row['facultyDiem']+$row['regFaculty']+($row['transpoFaculty']*2);
                        }

                              if ($out != "[") {$out .= ",";}
                              $out .= '{"masid":"'. $row['masid']. '",'; 
                              $out .= '"budget":"'. $budget. '"}'; 


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