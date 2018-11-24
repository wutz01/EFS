<?php
include('../db/config.php');

$action = $_GET['action'];
$result = array();

switch($action){
	case 'approve_seminar':
	$reqid = $_GET['reqid'];
	$pos = $_GET['position'];
	approveSem($reqid,$pos);
	break;
}


function approveSem($reqid,$pos){

	$findReq = mysql_query("
		SELECT * FROM sem_emp 
		INNER JOIN profile 
		ON sem_emp.email = profile.email 
		WHERE sem_emp.id = '$reqid' 
		");
	while($rows=mysql_fetch_assoc($findReq)){
		$email = $rows['email'];
		$college = $rows['college'];
	}
	switch($pos){
		case 'chair':
		$user_to = "dean";
		$q = mysql_query("UPDATE sem_emp SET chair_status = 1 WHERE id = '$reqid' ");
		break;
		case 'dean':
		$user_to = "vpar";
		$q = mysql_query("UPDATE sem_emp SET chair_status = 1,dean_status = 1 WHERE id = '$reqid' ");
		break;
		case 'vpar':
		$user_to = "hr";
		$q = mysql_query("UPDATE sem_emp SET chair_status = 1,dean_status = 1,vpar_status = 1 WHERE id = '$reqid' ");
		break;
		case 'hr':
		$user_to = "md";
		$q = mysql_query("UPDATE sem_emp SET chair_status = 1,dean_status = 1,vpar_status = 1,hr_status = 1 WHERE id = '$reqid' ");
		break;
		case 'md':
		$user_to = "approved";
		$q = mysql_query("UPDATE sem_emp SET chair_status = 1,dean_status = 1,vpar_status = 1,hr_status = 1,md_status = 1 WHERE id = '$reqid' ");
		break;
	}

	if($q){
		echo "ok";
	}else{
		echo "WTF";
	}

	$logUser = $email;
	if($user_to!="approved"){
		$content = mysql_real_escape_string("New Seminar <span class='text-warning'>pending</span> for your approval.");
		$addNotifs = mysql_query("INSERT INTO notif (type,user_from,user_to,content,college,date_created) 
			VALUES ('seminar','$logUser','$user_to','$content','$college',now()) ");
	}else{
		$content = mysql_real_escape_string("Your requested seminar has been <span class='text-success'>approved</span>.");
		$addNotifs = mysql_query("INSERT INTO notif (type,user_from,user_to,content,college,date_created) 
			VALUES ('seminar approved','$logUser','$user_to','$content','$college',now()) ");
	}
}
?>