<?php

include('../db/config.php');

$ma = array();

$action = $_GET['action'];
switch ($action) {
	case 'overall':
		overall($conn);
		break;
	case 'suggest':
		$email = $_GET['email'];
		$dept = $_GET['dept'];
		suggest($email,$dept);
		break;
	
	case 'search':
		$key = $_GET['key'];
		keySearch($conn,$key);
		break;
	case 'find':
		$title = $_GET['title'];
		$email = $_GET['email'];
		find($email,$title);
		break;		
	default:
		# code...
		break;
}


function overall($conn){

	$q = mysql_query("SELECT * FROM mustattend");
	if(mysql_num_rows($q)!=0){
		$budgetAll = 0;
		while($rows=mysql_fetch_assoc($q))
		{
			$title = $rows['title'];
			$budget = $rows['budget'];
			echo "
			<tr>
				<td>$title</td>
				<td></td>
				<td></td>
				<td>$budget</td>
			<tr>
			";
		}
		echo "
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td class='text-right'><strong>Total: &#8369;$budget</strong></td>
		<tr>
		";
	}else{

	}

}

function suggest($email,$dept){
	$ma = array();
	$ay = '2016-2017';

	$q = mysql_query("
		SELECT mustattend.title 
		FROM mustattend 
		WHERE title 
		NOT IN
			(
			SELECT mustattend.title 
			FROM sem_emp,mustattend 
			WHERE sem_emp.sem_id = mustattend.masid 
			AND sem_emp.email = '$email'
			)
		AND mustattend.department = '$dept'
		AND mustattend.academicyear = '$ay'
		");
	if(mysql_num_rows($q)!=0){
		while($rows=mysql_fetch_assoc($q))
		{
			$ma[] = $rows['title'];
		}
	}else{

	}

	$q2 = mysql_query("
			SELECT othersem.title 
			FROM othersem 
			WHERE title NOT 
			IN
				(
				SELECT othersem.title 
				FROM sem_emp,othersem 
				WHERE sem_emp.sem_id = othersem.otherSem_Id 
				AND sem_emp.email = '$email'
				)
			AND othersem.academicyear = '$ay'
			");
		if(mysql_num_rows($q2)!=0){
			while($rows=mysql_fetch_assoc($q2))
			{
				$ma[] = $rows['title'];
			}
		}else{

		}

	header('content-type: application/json');
	echo json_encode($ma);
}

function find($email,$title){
	$ay = '2016-2017';

	$getId = mysql_query("SELECT mustattend.masid FROM mustattend WHERE mustattend.title='$title' AND mustattend.academicyear  = '$ay' ");
	if(mysql_num_rows($getId)!=0){
		while($rows=mysql_fetch_assoc($getId))
		{
			$masId = $rows['masid'];
		}

		//my budget
		$getPos = mysql_query("SELECT account.usertype FROM account WHERE email = '$email' ");
		while($rows=mysql_fetch_assoc($getPos))
		{
			$position = $rows['usertype'];
		}

		if($position=="dean"){
			$getMyBudget = mysql_query("SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM masbreakdown WHERE masid = '$masId'");
		}else if($position=="chair"){
			$getMyBudget = mysql_query("SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE masid = '$masId'");
		}else if($position=="faculty"){
			$getMyBudget = mysql_query("SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM masbreakdown WHERE masid = '$masId'");
		}else{
			echo "HOW?";
		}
		while($rows=mysql_fetch_assoc($getMyBudget))
		{
			$my_budget = $rows['my_budget'];
		}

		//seminar details
		$masDetails = mysql_query("
			SELECT * FROM mustattend 
			INNER JOIN masbreakdown
			ON mustattend.masid = masbreakdown.masid
			WHERE mustattend.masid='$masId'
		");

		//total budget
		$getProposedBudget = mysql_query("
			SELECT
			(
				(masbreakdown.deanHotel * masbreakdown.numofdean)
				+ (masbreakdown.chairHotel * masbreakdown.numofchair) 
				+ (masbreakdown.facultyHotel * masbreakdown.numoffaculty)
				+ (masbreakdown.deanDiem * masbreakdown.numofdean) 
				+ (masbreakdown.chairDiem * masbreakdown.numofchair) 
				+ (masbreakdown.facultyDiem * masbreakdown.numoffaculty)
				+ (masbreakdown.regDean * masbreakdown.numofdean)
				+ (masbreakdown.regChair * masbreakdown.numofchair)
				+ (masbreakdown.regFaculty * masbreakdown.numoffaculty)
				+ (masbreakdown.transpoDean * masbreakdown.numofdean)
				+ (masbreakdown.transpoChair * masbreakdown.numofchair)
				+ (masbreakdown.transpoFaculty * masbreakdown.numoffaculty)
			) AS proposed_budget

			FROM mustattend 
			INNER JOIN masbreakdown
			ON mustattend.masid = masbreakdown.masid
			WHERE mustattend.masid = '$masId'
					");

		while($rows=mysql_fetch_assoc($getProposedBudget)){
			$proposed_budget = $rows['proposed_budget'];
		}
		
		if(mysql_num_rows($masDetails)!=0){
			while($rows=mysql_fetch_assoc($masDetails))
			{
				$numDean = $rows['numofdean'];
				$numChair = $rows['numofchair'];
				$numFaculty = $rows['numoffaculty'];
				$persons = $numDean+$numChair+$numFaculty;

				$includes = array();
				if($numDean!=0){
					array_push($includes, "Deans");
				}
				if($numChair!=0){
					array_push($includes, "Chairs");
				}
				if($numFaculty!=0){
					array_push($includes, "Faculty");
				}

				$includes = implode(',', $includes);

				$ma = array(
					"academicyear" => $rows['academicyear'],
					"masid" => $rows['masid'],
					"title" => $rows['title'],
					"datecreated" => $rows['datecreated'],
					"school" => $rows['school'],
					"department" => $rows['department'],
					"category" => $rows['category'],
					"sponsor" => $rows['sponsor'],
					"dates" => $rows['dates'],
					"numdays" => $rows['numdays'],
					"venue" => $rows['venue'],
					"numDean" => $numDean,
					"numChair" => $numChair,
					"numFaculty" => $numFaculty,
					"persons" => $persons,
					"includes" => $includes
					);
				$ma['budget'][] = array(
					"deanHotel" => $rows['deanHotel'],
					"deanDiem" => $rows['deanDiem'],
					"chairHotel" => $rows['chairHotel'],
					"chairDiem" => $rows['chairDiem'],
					"facultyHotel" => $rows['facultyHotel'],
					"facultyDiem" => $rows['facultyDiem'],
					// "regFee" => $rows['regfee'],
					// "foodFee" => $rows['foodfee'],
					// "transFee" => $rows['transfee'],
					"proposed_budget" => number_format($proposed_budget,2,'.',', '),
					"my_budget" => number_format($my_budget,2,'.',', '),
					);
			}

			$getAttendees = mysql_query("
				SELECT * FROM sem_emp 
				INNER JOIN account 
				ON sem_emp.email = account.email
				INNER JOIN profile
				ON account.email = profile.email
				INNER JOIN mustattend 
				ON sem_emp.sem_id = mustattend.masid 
				WHERE sem_emp.sem_id = '$masId'
			");
			if(mysql_num_rows($getAttendees)!=0){
				while($rows=mysql_fetch_assoc($getAttendees))
				{
					$ma['attendees'][] = array(
						"email" => $rows['email'],
						"firstname" => $rows['firstname'],
						"lastname" => $rows['lastname'],
						"middlename" => $rows['middlename'],
						"designation" => $rows['designation'],
						"position" => $rows['college']." ".ucwords($rows['designation']),
						"college" => $rows['college'],
						"school" => $rows['school'],
						);
				}
			}

			//budget breakdown

			header('content-type: application/json');
			echo json_encode($ma);
		}else{
			echo "empty";
		}
	}else{
		$getId2 = mysql_query("SELECT othersem.otherSem_Id FROM othersem WHERE othersem.title='$title' AND othersem.academicyear  = '$ay' ");
		if(mysql_num_rows($getId2)!=0){
			while($rows=mysql_fetch_assoc($getId2))
			{
				$masId = $rows['otherSem_Id'];
			}

			$masDetails = mysql_query("
				SELECT * FROM othersem 
				INNER JOIN othersembreakdown
				ON othersem.otherSem_Id = othersembreakdown.otherSem_id
				WHERE othersem.otherSem_Id='$masId' 
			");

			//my budget
			$getPos = mysql_query("SELECT account.usertype FROM account WHERE email = '$email' ");
			while($rows=mysql_fetch_assoc($getPos))
			{
				$position = $rows['usertype'];
			}

			if($position=="dean"){
				$getMyBudget = mysql_query("SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM masbreakdown WHERE masid = '$masId'");
			}else if($position=="chair"){
				$getMyBudget = mysql_query("SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE masid = '$masId'");
			}else if($position=="faculty"){
				$getMyBudget = mysql_query("SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM masbreakdown WHERE masid = '$masId'");
			}else{
				echo "HOW?";
			}
			while($rows=mysql_fetch_assoc($getMyBudget))
			{
				$my_budget = $rows['my_budget'];
			}

			//total budget
			$getProposedBudget = mysql_query("
				SELECT
				(
					(masbreakdown.deanHotel * masbreakdown.numofdean)
					+ (masbreakdown.chairHotel * masbreakdown.numofchair) 
					+ (masbreakdown.facultyHotel * masbreakdown.numoffaculty)
					+ (masbreakdown.deanDiem * masbreakdown.numofdean) 
					+ (masbreakdown.chairDiem * masbreakdown.numofchair) 
					+ (masbreakdown.facultyDiem * masbreakdown.numoffaculty)
					+ (masbreakdown.regDean * masbreakdown.numofdean)
					+ (masbreakdown.regChair * masbreakdown.numofchair)
					+ (masbreakdown.regFaculty * masbreakdown.numoffaculty)
					+ (masbreakdown.transpoDean * masbreakdown.numofdean)
					+ (masbreakdown.transpoChair * masbreakdown.numofchair)
					+ (masbreakdown.transpoFaculty * masbreakdown.numoffaculty)
				) AS proposed_budget

				FROM mustattend 
				INNER JOIN masbreakdown
				ON mustattend.masid = masbreakdown.masid
				WHERE mustattend.masid = '$masId'
				");

			while($rows=mysql_fetch_assoc($getProposedBudget)){
				$proposed_budget = $rows['proposed_budget'];
			}
			
			//seminar details
			if(mysql_num_rows($masDetails)!=0){
				while($rows=mysql_fetch_assoc($masDetails))
				{
					$numDean = $rows['numofdean'];
					$numChair = $rows['numofchair'];
					$numFaculty = $rows['numoffaculty'];
					$persons = $numDean+$numChair+$numFaculty;

					$includes = array();
					if($numDean!=0){
						array_push($includes, "Deans");
					}
					if($numChair!=0){
						array_push($includes, "Chairs");
					}
					if($numFaculty!=0){
						array_push($includes, "Faculty");
					}

					$includes = implode(',', $includes);

					$ma = array(
						"academicyear" => $rows['academicyear'],
						"masid" => $rows['otherSem_id'],
						"title" => $rows['title'],
						"datecreated" => $rows['datecreated'],
						"school" => $rows['school'],
						"department" => $rows['department'],
						"category" => $rows['category'],
						"sponsor" => $rows['sponsor'],
						"dates" => $rows['dates'],
						"numdays" => $rows['numdays'],
						"venue" => $rows['venue'],
						"numDean" => $numDean,
						"numChair" => $numChair,
						"numFaculty" => $numFaculty,
						"persons" => $persons,
						"includes" => $includes
						);
					$ma['budget'][] = array(
						"deanHotel" => $rows['deanHotel'],
						"deanDiem" => $rows['deanDiem'],
						"chairHotel" => $rows['chairHotel'],
						"chairDiem" => $rows['chairDiem'],
						"facultyHotel" => $rows['facultyHotel'],
						"facultyDiem" => $rows['facultyDiem'],
						// "regFee" => $rows['regfee'],
						// "foodFee" => $rows['foodfee'],
						// "transFee" => $rows['transfee'],
						"proposed_budget" => number_format($proposed_budget,2,'.',', '),
						"my_budget" => number_format($my_budget,2,'.',', '),
						);
				}

				$getAttendees = mysql_query("
					SELECT * FROM sem_emp 
					INNER JOIN account 
					ON sem_emp.email = account.email
					INNER JOIN profile
					ON account.email = profile.email
					INNER JOIN mustattend 
					ON sem_emp.sem_id = mustattend.masid 
					WHERE sem_emp.sem_id = '$masId'
				");
				if(mysql_num_rows($getAttendees)!=0){
					while($rows=mysql_fetch_assoc($getAttendees))
					{
						$ma['attendees'][] = array(
							"email" => $rows['email'],
							"firstname" => $rows['firstname'],
							"lastname" => $rows['lastname'],
							"middlename" => $rows['middlename'],
							"designation" => $rows['designation'],
							"position" => $rows['college']." ".ucwords($rows['designation']),
							"college" => $rows['college'],
							"school" => $rows['school'],
							);
					}
				}

				//budget breakdown
				header('content-type: application/json');
				echo json_encode($ma);
			}else{
				echo "empty";
			}
		}

	}

}

function keySearch($conn,$key){
	$getId = mysql_query("SELECT * FROM mustattend WHERE title='$key' ");
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