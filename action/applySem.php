<?php

include('../db/config.php');
session_start();
$masid = $_POST['masid'];
$email = $_POST['email'];
// $echoSched = implode(';', $_POST['echoSched']);
$echoSched = $_POST['echoSched'];
$docs = $_POST['docs'];
$reasons = $_POST['reasons'];
$type = $_POST['type'];

//upload CODE
$docsArray = array();
$i = 0;
foreach($_FILES['docs']['name'] as $filename){
	$docsArray[] = $filename;
	$targetPath = "../uploads/".$filename;
	move_uploaded_file($_FILES['docs']['tmp_name'][$i], $targetPath);
	$i++;
}
$docs = implode(';', $docsArray);


$findEmail = mysql_query("
	SELECT account.usertype,profile.college
	FROM account 
	INNER JOIN profile 
	ON account.email = profile.email 
	WHERE account.email = '$email'
	");
while($rows=mysql_fetch_assoc($findEmail)){
	$pos = $rows['usertype'];
	$college = $rows['college'];
}

switch($pos){
	case 'faculty':
		$user_to = "chair";
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',0,0,0,0,0)");
	break;
	case 'chair':
		$user_to = "dean";
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,0,0,0,0)");
	break;
	case 'dean':
		$user_to = "vpar";
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,0,0,0)");
	break;
	case 'vpar':
		$user_to = "hr";
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,0,0)");
	break;
	case 'hr':
		$user_to = "md";
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,1,0)");
	break;
	case 'md':
		$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
		VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,1,1)");
	break;
}

	$logUser = $email;
	$content = mysql_real_escape_string("New Seminar <span class='text-warning'>pending</span> for your approval.");
	$addNotifs = mysql_query("INSERT INTO notif (type,user_from,user_to,content,college,date_created) 
		VALUES ('seminar','$logUser','$user_to','$content','$college',now()) ");