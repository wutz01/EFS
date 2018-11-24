<?php

include('../db/config.php');

$ma = array();

$action = $_GET['action'];
$ay = $_GET['ay'];

switch ($action) {
	case 'overallMa':
		$school = $_GET['school'];
		overallMa($conn,$ay,$school);
		break;
	case 'suggestMa':
		suggestMa($conn,$ay);
		break;
	case 'searchMa':
		$key = $_GET['key'];
		keySearchMa($conn,$key,$ay);
		break;

	case 'overallOther':
		overallOther($conn,$ay);
		break;
	case 'suggestOther':
		suggestOther($conn,$ay);
		break;
	case 'searchOther':
		$key = $_GET['key'];
		keySearchOther($conn,$key,$ay);
		break;

	case 'overallTNA':
		overallTNA($conn,$ay);
		break;
	case 'suggestTNA':
		suggestTNA($conn,$ay);
		break;
	case 'searchTNA':
		$key = $_GET['key'];
		keySearchTNA($conn,$key,$ay);
		break;

	default:
		# code...
		break;
}

//must-attend
function overallMa($conn,$ay,$school){
	if($school!="All"){
		$allMa = mysql_query("SELECT * FROM mustattend WHERE academicyear = '$ay' AND school='$school' ");
	}else{
		$allMa = mysql_query("SELECT * FROM mustattend WHERE academicyear = '$ay' ");
	}

	if(mysql_num_rows($allMa)!=0){
		while($rows=mysql_fetch_assoc($allMa))
		{
			$masId = $rows['masid'];
			$checkAttended = mysql_query("
				SELECT * FROM sem_emp
				INNER JOIN profile
				ON sem_emp.email = profile.email		
				WHERE sem_emp.attended = 'yes' 
				AND sem_emp.sem_id = '$masId' 
				");
			$attended = mysql_num_rows($checkAttended);

			$maDetails = mysql_query("
				SELECT * FROM mustattend 
				INNER JOIN masbreakdown
				ON mustattend.masid = masbreakdown.masid
				WHERE mustattend.masid='$masId'
				");
			if(mysql_num_rows($maDetails)!=0){
				while($rows=mysql_fetch_assoc($maDetails))
				{	
					$numDean = $rows['numofdean'];
					$numChair = $rows['numofchair'];
					$numFac = $rows['numoffaculty'];
					$persons = $numDean+$numChair+$numFac;

					$ma[] = array(
						"title" => $rows['title'],
						"budget" => $rows['budget'],
						"attended" => $attended,
						"persons" => $persons,
						);
				}
			}
		}

		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}

}

function suggestMa($conn,$ay){
	$q = mysql_query("SELECT * FROM mustattend WHERE academicyear = '$ay'");
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{
			$ma[] = $rows['title'];
		}

		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}

}

function keySearchMa($conn,$key,$ay){
	$getId = mysql_query("SELECT * FROM mustattend WHERE title='$key' AND academicyear='$ay'");
	while($rows=mysql_fetch_assoc($getId))
	{
		$masId = $rows['masid'];
	}



	$q = mysql_query("
		SELECT * FROM mustattend 
		INNER JOIN masbreakdown
		ON mustattend.masid = masbreakdown.masid
		WHERE mustattend.masid='$masId'
		");


	$checkAttended = mysql_query("
		SELECT * FROM sem_emp
		INNER JOIN profile
		ON sem_emp.email = profile.email		
		WHERE sem_emp.attended = 'yes' 
		AND sem_emp.sem_id = '$masId' 
		");
	$attended = mysql_num_rows($checkAttended);
	
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{	
			$numDean = $rows['numofdean'];
			$numChair = $rows['numofchair'];
			$numFac = $rows['numoffaculty'];
			$persons = $numDean+$numChair+$numFac;

			$ma = array(
				"title" => $rows['title'],
				"budget" => $rows['budget'],
				"persons" => $persons,
				"attended" => $attended
				);
		}
		
		$findAttended = mysql_query("
			SELECT * FROM sem_emp
			INNER JOIN profile
			ON sem_emp.email = profile.email		
			WHERE sem_emp.sem_id = '$masId' 
			");
		if(mysql_num_rows($findAttended)!=0){
			while($rows=mysql_fetch_assoc($findAttended))	{
				$ma['attendees'][] = array(
					"fullname" => $rows['firstname']." ".$rows['middlename'][0].". ".$rows['lastname'],
					"position" => $rows['college']." ".ucwords($rows['designation']),
					"attended" => $rows['attended']
					);
			}
		}
		header('content-type: application/json');
		echo json_encode($ma);
	}else{
	}
}


//other
function overallOther($conn,$ay){

	$allMa = mysql_query("SELECT * FROM othersem WHERE academicyear = '$ay' ");
	if(mysql_num_rows($allMa)!=0){
		while($rows=mysql_fetch_assoc($allMa))
		{
			$masId = $rows['otherSem_id'];
			$checkAttended = mysql_query("
				SELECT * FROM sem_emp
				INNER JOIN profile
				ON sem_emp.email = profile.email		
				WHERE sem_emp.attended = 'yes' 
				AND sem_emp.sem_id = '$masId' 
				");
			$attended = mysql_num_rows($checkAttended);

			$maDetails = mysql_query("
				SELECT * FROM othersem 
				INNER JOIN othersembreakdown
				ON othersem.otherSem_id = othersembreakdown.otherSem_id
				WHERE othersem.otherSem_id='$masId'
				");
			if(mysql_num_rows($maDetails)!=0){
				while($rows=mysql_fetch_assoc($maDetails))
				{	
					$numDean = $rows['numofdean'];
					$numChair = $rows['numofchair'];
					$numFac = $rows['numoffaculty'];
					$persons = $numDean+$numChair+$numFac;

					$ma[] = array(
						"title" => $rows['title'],
						"budget" => $rows['budget'],
						"attended" => $attended,
						"persons" => $persons,
						);
				}
			}
		}
		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}

}

function suggestOther($conn,$ay){
	$q = mysql_query("SELECT * FROM othersem WHERE academicyear = '$ay'");
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{
			$ma[] = $rows['title'];
		}

		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}

}

function keySearchOther($conn,$key,$ay){
	$getId = mysql_query("SELECT * FROM othersem WHERE title='$key' ");
	while($rows=mysql_fetch_assoc($getId))
	{
		$masId = $rows['otherSem_id'];
	}



	$q = mysql_query("
		SELECT * FROM othersem 
		INNER JOIN othersembreakdown
		ON othersem.otherSem_id = othersem.otherSem_id
		WHERE othersem.otherSem_id='$masId'
		");


	$checkAttended = mysql_query("
		SELECT * FROM sem_emp
		INNER JOIN profile
		ON sem_emp.email = profile.email		
		WHERE sem_emp.attended = 'yes' 
		AND sem_emp.sem_id = '$masId' 
		");
	$attended = mysql_num_rows($checkAttended);
	
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{	
			$numDean = $rows['numofdean'];
			$numChair = $rows['numofchair'];
			$numFac = $rows['numoffaculty'];
			$persons = $numDean+$numChair+$numFac;

			$ma = array(
				"title" => $rows['title'],
				"budget" => $rows['budget'],
				"persons" => $persons,
				"attended" => $attended
				);
		}
		
		$findAttended = mysql_query("
			SELECT * FROM sem_emp
			INNER JOIN profile
			ON sem_emp.email = profile.email		
			WHERE sem_emp.sem_id = '$masId' 
			");
		if(mysql_num_rows($findAttended)!=0){
			while($rows=mysql_fetch_assoc($findAttended))	{
				$ma['attendees'][] = array(
					"fullname" => $rows['firstname']." ".$rows['middlename'][0].". ".$rows['lastname'],
					"position" => $rows['college']." ".ucwords($rows['designation']),
					"attended" => $rows['attended']
					);
			}
		}
		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}
}


//TNA
function overallTNA($conn,$ay){
	$a = mysql_query("
		SELECT * FROM tna 
		INNER JOIN profile
		ON tna.email = profile.email
		WHERE annualyear = '$ay'
		GROUP BY tna.email
		");
	if(mysql_num_rows($a)!=0){
		while($rows=mysql_fetch_assoc($a))
		{
			$email = $rows['email'];
			$fname = $rows['firstname'];
			$mname = $rows['middlename'];
			$lname = $rows['lastname'];
			$department = $rows['department'];
			$designation = $rows['designation'];
			
			$getCompleted = mysql_query("
				SELECT * FROM tna 
				INNER JOIN profile
				ON tna.email = profile.email
				WHERE tna.email='$email' 
				AND tna.evidence !=''
				");
			$completed = mysql_num_rows($getCompleted);
			
			$getTNA = mysql_query("
				SELECT * FROM tna 
				INNER JOIN profile
				ON tna.email = profile.email
				WHERE tna.email='$email'
				");
			// $jrc = array();
			// if(mysql_num_rows($getTNA)!=0){
			// 	while($rows=mysql_fetch_assoc($getTNA))
			// 	{
			// 		$jrc[] = array(
			// 			"title" => $rows['job_role'],
			// 			"position" => $rows['position_importance'],
			// 			"ability" => $rows['ability'],
			// 			"competency" => $rows['competency'],
			// 			"devplan" => $rows['developmentplan'],
			// 			"evidence" => $rows['evidence'],
			// 			);
			// 	}
			// }
			$ma[] = array(
				"fullname" => $fname." ".$mname[0].". ".$lname,
				"position" => $department." ".ucwords($designation),
				"department" => $department,
				"completed" => $completed,
				"jobroles" => mysql_num_rows($getTNA),
				// "jrc" => $jrc
				);
		}
		header('content-type: application/json');
		echo json_encode($ma);	
	}else{

	}



		
	
}

function suggestTNA($conn,$ay){
	$q = mysql_query("
		SELECT * FROM tna
		INNER JOIN profile
		ON tna.email = profile.email 
		WHERE tna.annualyear = '$ay' GROUP BY tna.email");
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{
			$ma[] = array(
				"name" => $rows['firstname']." ".$rows['middlename'][0].". ".$rows['lastname'],
				"email" => $rows['email']
				);
		}

		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}

}

function keySearchTNA($conn,$key,$ay){
	$getTNA = mysql_query("
		SELECT * FROM tna 
		INNER JOIN profile
		ON tna.email = profile.email
		WHERE tna.email='$key'
		");
	$getCompleted = mysql_query("
		SELECT * FROM tna 
		INNER JOIN profile
		ON tna.email = profile.email
		WHERE tna.email='$key' 
		AND tna.evidence !=''
		");

	$completed = mysql_num_rows($getCompleted);
	if(mysql_num_rows($getTNA)!=0){
		while($rows=mysql_fetch_assoc($getTNA))
		{
			$ma['fullname'] = $rows['firstname']." ".$rows['middlename'][0].". ".$rows['lastname'];
			$ma['position'] = $rows['department']." ".ucwords($rows['designation']);
			$ma['department'] = $rows['department'];
			$ma['completed'] = $completed;
			$ma['jobroles'] = mysql_num_rows($getTNA);
			$ma['jrc'][] = array(
				"title" => $rows['job_role'],
				"position" => $rows['position_importance'],
				"ability" => $rows['ability'],
				"competency" => $rows['competency'],
				"devplan" => $rows['developmentplan'],
				"evidence" => $rows['evidence'],
				);
		}
		header('content-type: application/json');
		echo json_encode($ma);
	}else{

	}
}