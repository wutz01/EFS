<?php

include('../db/config.php');

$action = $_GET['action'];
$result = array();

switch($action){
	case 'employee':
	$value = $_GET['value'];
	addEmployee($value);
	break;
	case 'seminar':
	$value = $_GET['value'];
	applySem($value);
	break;
	case 'hr-inhouse-save':
	$value = $_GET['value'];
	addInHouse($value);
	break;
	case 'add_category':
	$category = $_GET['value'];
	addCategory($category);
	break;
	case 'add_devplan':
	$devplan = $_GET['value'];
	addDevplan($devplan);
	break;
	case 'add_jobroles':
	$jobrole = $_GET['value'];
	addJobrole($jobrole);
	break;
}


function addEmployee($data){

	$email = $data['email'];
	$fname = $data['fname'];
	$lname = $data['lname'];
	$mname = $data['mname'];
	$pos = strtolower($data['pos']);
	$dept = $data['dept'];


	$getDept = mysql_query("
			SELECT faith_department.id,faith_department.abbr,faith_school.school FROM faith_school 
			INNER JOIN faith_department 
			ON faith_school.id = faith_department.school_id 
			WHERE faith_department.id = '$dept'
			");
	while($rows = mysql_fetch_assoc($getDept)){
		$dept_word = $rows['abbr'];
		$school = $rows['school'];
	}

	if($school == "School of Technology"){
		$school_word = "Technology";
	}else if($school == "School of Humanities"){
		$school_word = "Humanities";
	}else{
		$school_word = "Management";
	}

	$q = mysql_query("
		INSERT INTO account (email, password, usertype) VALUES('$email', '1234567', '$pos');
		");

	$q2 = mysql_query("
		INSERT INTO profile (email, firstname, middlename, lastname, designation, college, school)
		VALUES ('$email','$fname','$mname','$lname','$pos','$dept_word','$school_word');
		");
	// echo $dept;
	// echo json_encode($result);
	// header("content-type: application/json");
}

function applySem($data){

	$masid = $data['masid'];
	$email = $data['email'];
	$echoSched = implode(';', $data['echoSched']);
	$docs = $data['docs'];
	$reasons = $data['reasons'];
	$type = $data['type'];

	$findEmail = mysql_query("SELECT account.usertype FROM account WHERE email = '$email' ");
	while($rows=mysql_fetch_assoc($findEmail)){
		$pos = $rows['usertype'];
	}

	switch($pos){
		case 'faculty':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',0,0,0,0,0)");
			break;
		case 'chair':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,0,0,0,0)");
			break;
		case 'dean':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,0,0,0)");
			break;
		break;
		case 'vpar':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,0,0)");
			break;
		break;
		case 'hr':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,1,0)");
			break;
		break;
		case 'md':
			$q = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons, type, chair_status, dean_status, vpar_status, hr_status, md_status)
			VALUES ('$masid','$email','$echoSched','$docs','$reasons','$type',1,1,1,1,1)");
			break;
		break;
	}

	echo json_encode($data);
	header("content-type: application/json");
}

function addInHouse($value){
	$id = rand(1,999999999);
	$title = $value['title'];
	$ay = $value['ay'];
	$venue = $value['venue'];
	$date = $value['date'];
	$emails = $value['attendees'];

	$q = mysql_query("INSERT INTO hr_inhouse (id,title, venue, datetime, academicyear) VALUES('$id','$title','$venue','$date','$ay')");
	foreach($emails as $email){
		$q2 = mysql_query("INSERT INTO hr_inhouse_emp (inhouse_id,emp_email) VALUES('$id','$email') ");
	}

	echo "ok";
}

function addCategory($category){
	$q = mysql_query("INSERT INTO mas_category (category) VALUES('$category') ");
	if($q){
		header("location: ../category.php");
	}else{
		echo "WTF";
	}
}

function addDevplan($devplan){
	$q = mysql_query("INSERT INTO tna_devplan (devplan) VALUES('$devplan') ");
	if($q){
		header("location: ../devplan.php");
	}else{
		echo "WTF";
	}
}

function addJobrole($jobrole){
	$q = mysql_query("INSERT INTO tna_jobroles (jobrole) VALUES('$jobrole') ");
	if($q){
		echo "ok";
	}else{
		echo "WTF";
	}
}