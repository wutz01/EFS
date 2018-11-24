<?php
// include("action/session-auth.php");
include("../db/config.php");
session_start();

$user = $_POST['user'];
$password = $_POST['pass'];
$pass = md5($password);

if($conn==TRUE){
	if(($user!=null)&&($pass!=null)){
	 $result = mysqli_query($conn,"SELECT * FROM user_account WHERE email = '$user' AND password = '$pass'");
			  $num_rows = mysqli_num_rows($result);
			  $row = mysqli_fetch_array($result);
			  if($num_rows>0){
			  	 	$usertype=$row['usertype_id'];
			  	 	$id=$row['id'];
			  	 	$_SESSION['username']=$row["email"];
			  	 	 	$result1 = mysqli_query($conn,"SELECT * FROM user_profile WHERE id= '$id'");
			  	 	  	$row1 = mysqli_fetch_array($result1);
			  	 	  	$_SESSION['firstname']=$row1["firstname"];
			  	 	  	$_SESSION['lastname']=$row1["lastname"];
			  	 		$_SESSION['middlename']=$row1["middlename"];
			  	 		$_SESSION['dept_id']=$row1['dept_id'];
			  	 		$_SESSION['accID'] = $row1['account_id'];
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
			  	header("location: ../login.php?login=failed1");

			  }

	}else{
		header("location: ../login.php?login=failed2");

	}

}else{
	echo "No Connection";
}


function getLogin($user){

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'efs';

$conn = mysqli_connect($host, $username, $password, $database);
$query4 = mysqli_query($conn,"SELECT * FROM `user_types` WHERE id = '$user'");
$row4 = mysqli_fetch_array($query4);

$user = $row4["user"];
	switch ($user) {
		case 'faculty':

			goHome($user);
		break;

		case 'staff':
			goHome($user);
		break;

		case 'chair':
			goHome($user);
		break;

		case 'dean':
		//$user='dean';
			goHome($user);
		break;

		case 'vpar':
			# code...
			$_SESSION['schooltype']="SOT";

			goHome($user);
		break;

		case 'hr':
			goHome($user);
			# code...
		break;

		case 'md':
			goHome($user);
		break;

		case 'research':
			goHome($user);
		break;

		case 'FACE':
			goHome($user);
		break;

		case 'admin':
			goHome($user);
		break;

		case 'dev':
			goHome($user);
		break;

		default:
		header("location: ../login.php?login=failed3");
		break;
	}

}

function goHome($user){

	$_SESSION['user'] = $user;
	header('location: ../index.php');
}

?>
