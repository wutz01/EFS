<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";


$email = $_POST['email'];
$masids = $_POST['masids'];
$reasons = $_POST['reasons'];
$category = $_POST['category'];

$chair_note="Approved";
$dean_note = "New";
$vp_note="New";
$hr_note="New";
$md_note="New";
if($conn==true){
	if(($email!=null)&&($masids!=null)&&($reasons!=null)&&($category)){

        
      

         	$result2 = mysql_query("SELECT * FROM applyseminar WHERE masid ='$masids' AND email='$email'");
            $row= mysql_fetch_assoc($result2);
            $num_rows2 = mysql_num_rows($result2);
            if($num_rows2<=0){
            	 $inserts2 = "Insert into applyseminar values ('','$masids','$email','$reasons','$category','$chair_note','$dean_note','$vp_note','$hr_note','$md_note')";
        		mysql_query($inserts2,$conn);
                $notification="1";
            }else{
                $notification="2";

            }


           
	}else{
		// echo "Do not leave blank form";
		$notification="3";
	}
}else{
	echo "No Connection";
}
$out='{"notification":"'.$notification.'"}';
echo $out;
?>