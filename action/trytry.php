<?php
// include("action/session-auth.php");
include("../db/config.php");
session_start();
$user = 'amlacorte@firstasia.edu.ph';
$pass = '1234567';

if($conn==TRUE){
	if(($user!=null)&&($pass!=null)){
	 $result = mysqli_query($conn,"SELECT * FROM user_account WHERE email = '$user' AND password='$pass'");
			  $num_rows = mysqli_num_rows($result);
			  $row = mysqli_fetch_array($result);
			  if($num_rows>0){
			  	 	$usertype=$row['usertype_id'];
			  	 	$_SESSION['username']=$row["email"];
			  	 	 	$result1 = mysqli_query($conn,"SELECT * FROM user_profile WHERE email = '$user'");
			  	 	  	$row1 = mysqli_fetch_array($result1);
			  	 	  	$_SESSION['firstname']=$row1["firstname"];
			  	 	  	$_SESSION['lastname']=$row1["lastname"];
			  	 		$_SESSION['middlename']=$row1["middlename"];
			  	 		$_SESSION['dept_id']=$row1['dept_id'];
			  	 		$dept_id=$row1['dept_id'];

			  	 		$result2 = mysqli_query($conn,"SELECT * FROM faith_department WHERE id = '$dept_id'");
			  	 		$row2 = mysqli_fetch_array($result2);
			  	 		$_SESSION['college'] = $row2["abbr"];
			  	 		$_SESSION['school'] = $row2["school_id"];
			  	 		$id=$row2['id'];
			  	 		$result3 = mysqli_query($conn,"SELECT * FROM faith_school WHERE id = '$id'");
			  	 		$row3 = mysqli_fetch_array($result3);
			  	 		$_SESSION['school'] = $row3["school"];
			  	 		$_SESSION['academicyear']="2016-2017";

			  			getLogin($usertype);

			  }

			  else{
			  	echo 'not Successful1';
			  	
			  }

	}
	else{
		echo 'not Successful2';
		
	}

}else{
	echo "No Connection";
}


function getLogin($user){
	$conn = mysqli_connect("localhost","root","","efsdpv2");

$query4=mysqli_query($conn,"select * from `user_types` where id='$user'");
$row4 = mysqli_fetch_array($query4);
$user = $row4["user"];
	switch ($user) {
		case '1':

			goHome($user);
		break;

		case '2':
			goHome($user);
		break;

		case '3':
			goHome($user);
		break;

		case 'dean':
		//$user='dean';
			echo 'Successful';
		break;

		case '5':
			# code...
			$_SESSION['schooltype']="SOT";

			goHome($user);
		break;

		case '6':
			goHome($user);
			# code...
		break;

		case '7':
			goHome($user);
		break;

		case '8':
			goHome($user);
		break;

		case '9':
			goHome($user);
		break;
		
		default:
		echo 'not Successful';
		break;
	}

}
?>
