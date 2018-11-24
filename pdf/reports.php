<?php
require('../plugins/fpdf/fpdf.php');
require('../db/config.php');
require('mc_table.php');


$masComp = "
(
	(masbreakdown.deanHotel * 
     					(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'dean'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.chairHotel * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'chair'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.facultyHotel * 
    					(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'faculty'
						AND sem_emp.email = user_account.email)  
    )
+
	(masbreakdown.deanDiem * 
     					(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'dean'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.chairDiem * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'chair'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.facultyDiem * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'faculty'
						AND sem_emp.email = user_account.email)
    )

+
	(masbreakdown.regDean * 
     					(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'dean'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.regChair * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'chair'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.regFaculty * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'faculty'
						AND sem_emp.email = user_account.email)
    )
 
+
	(masbreakdown.transpoDean * 
     					(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND user_types.user = 'dean'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.transpoChair * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND account.usertype = 'chair'
						AND sem_emp.email = user_account.email)
    ) + (masbreakdown.transpoFaculty * 
         				(SELECT COUNT(sem_emp.email) AS ROWS
						FROM sem_emp, user_account 
						WHERE attended = 'yes' 
						AND sem_id = mustattend.mas_id 
                        AND account.usertype = 'faculty'
						AND sem_emp.email = user_account.email)
    )

) AS budget,";
$conn = mysqli_connect("localhost","root","","efsdpv2");
$result = mysqli_query($conn, "SELECT sem_emp.sem_id AS req_id, sem_emp.chair_status AS chair_stat, sem_emp.dean_status AS dean_stat, sem_emp.vpar_status AS vpar_stat, sem_emp.hr_status AS hr_stat, sem_emp.md_status AS md_stat, sem_emp.email, mustattend.title, mustattend.category, mustattend.venue, mustattend.dates FROM sem_emp INNER JOIN mustattend ON sem_emp.sem_id = mustattend.mas_id WHERE email != '".$_SESSION['username']."'ORDER BY sem_emp.sem_id DESC");

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$type = $_GET['type'];}

switch ($type) {
	case 'overall':
		// overall();
		break;
	case 'perCollege':
		perCollege($masComp);
		break;
	case 'perSeminar':
		perSeminar($masComp);
		break;
	case 'perCollege2':
		perCollege2();
		break;
	case 'compBudget':
		compBudget($masComp);
		break;
	case 'others':
		others();
		break;
	case 'tnaSum':
		tnaSum();
		break;
	case 'tna':
		tna();
		break;
	case 'tnaFac':
		tnaFac();
	case 'mas':
		mas();
		break;
	case 'fsdp':
		fsdp($masComp);
		break;
	case 'masresearch':
		masResearch();
		break;
	case 'masface':
		masFace();
	case 'researchbudget':
		researchBudget();
	default:
		# code...
		break;
}

function formatNumber($number){
	return number_format($number,2,'.',', ');
}

function overall(){

	class PDF extends FPDF
	{

		function BasicTable($header, $data)
		{
		    foreach($header as $col)
		        $this->Cell(47,10,$col,1);
		    $this->Ln();
		    foreach($data as $row)
		    {
		        
			    $this->Cell(47,6,$row['title'],1);
			    $this->Cell(47,6,$row['attended'],1);
			    $this->Cell(47,6,$row['percentage'],1);
			    $this->Cell(47,6,$row['budget'],1,'','R');
		        $this->Ln();
		    }
		}
	}

	$sc = array();
	$ay = '2016-2017';

	$allSc = mysqli_query($conn, "SELECT school FROM faith_school");
	while($rows=mysqli_fetch_assoc($allSc)){
		$school = $rows['school'];
	
		$allMa = mysqli_query($conn, "SELECT * FROM mustattend WHERE academicyear = '$ay' AND department = '".$_SESSION['college']."' ORDER BY title");
		if(mysqli_num_rows($allMa)!=0){
			$ma = array();
			$totalA = 0;
			$totalP = 0;
			$totalB = 0;
			$totalPer = 0;
			while($rows=mysqli_fetch_assoc($allMa))
			{
				$masId = $rows['mas_id'];
				$checkAttended = mysqli_query($conn, "
					SELECT * FROM sem_emp
					INNER JOIN user_account
					ON sem_emp.email = user_account.email		
					WHERE sem_emp.attended = 'yes' 
					AND sem_emp.sem_id = '$masId' 
					");
				$attended = mysqli_num_rows($checkAttended);

				$maDetails = mysqli_query($conn, "
					SELECT * FROM mustattend 
					INNER JOIN mas_breakdown
					ON mustattend.mas_id = mas_breakdown.mas_list_id
					WHERE mustattend.mas_id='$masId'
					");

				if(mysqli_num_rows($maDetails)!=0){
					while($rows=mysqli_fetch_assoc($maDetails))
					{	
						$numDean = $rows['numofdean'];
						$numChair = $rows['numofchair'];
						$numFac = $rows['numoffaculty'];
						$persons = $numDean+$numChair+$numFac;

						$totalA += $attended;
						$totalP += $persons;
						$totalB += $rows['budget'];
						$attendees = $attended."/".$persons;
						$percentage = ($attended/$persons)*100;
						$ma[] = array(
							"title" => $rows['title'],
							"attended" => $attendees,
							"percentage" => $percentage."%",
							"budget" => number_format($rows['budget'],2,'.',', '),
							);

					}
				}
			}
		}else{
			$totalA = 0;
			$totalP = 0;
			$totalB = 0;
			$totalPer = 0;
			$ma = array();
			$ma[] = array(
				"title" => 'N/A',
				"attended" => 0,
				"percentage" => 0,
				"budget" => 0,
				);
		}

		if($totalP!=0){
			$totalPer = ($totalA/$totalP)*100;
		}else{
			$totalPer = "0/0";
		}

		$sc[] = array(
			"school" => $school,
			"totalBudget" => $totalB,
			"totalPer" => round($totalPer,2),
			"totalAP" => $totalA.'/'.$totalP,
			"ma" => $ma
			);
	}

	// header('content-type: application/json');
	// echo json_encode($sc);

	$pdf = new PDF('L');

	foreach($sc as $s){
		$header = array('Seminar', 'Attendees', 'Percentage (%)', '(Php) Budget');
		$pdf->AddPage();

		$pdf->SetFont('Arial','',18);
		$pdf->Cell(47,10,'Must-Attend Seminars('.$s['school'].')',0);
		$pdf->Ln();

		$pdf->SetFont('Arial','',14);
		$pdf->BasicTable($header,$s['ma']);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(47,10,'Total',1);
		$pdf->SetFont('Arial','',14);
		$pdf->Cell(47,10,$s['totalAP'],1);
		$pdf->Cell(47,10,$s['totalPer']."%",1);
		$pdf->Cell(47,10,number_format($s['totalBudget'],2,'.',', '),1,'','R');
	}
	$pdf->Output();
}

function perCollege($masComp){
	$fs = 18;
	$cw = 60;
	class PDF extends FPDF
	{
		function BasicTable($data)
		{
		    $this->Cell(80,10,'Seminar Title',1);
		    $this->Cell(60,10,'# of Approved Attendees',1);
		    $this->Cell(60,10,'Percentage (%)',1);
		    $this->Cell(60,10,'(Php) Budget',1);
		    $this->Ln();
		    foreach($data as $row)
		    {
		        
			    $this->Cell(80,6,$row['title'],1);
			    $this->Cell(60,6,$row['attended'],1);
			    $this->Cell(60,6,$row['percentage'],1);
			    $this->Cell(60,6,$row['budget'],1,'','R');
		        $this->Ln();
		    }
		}
	}

	$sc = array();
	$ay = '2016-2017';

	if(isset($_GET['dept'])){
		$dept = $_GET['dept'];
		$allSc = mysqli_query($conn, "SELECT abbr,department FROM faith_department WHERE abbr = '".$_SESSION['college']);
	}else{
		$allSc = mysqli_query($conn, "SELECT abbr,department FROM faith_department");
	}

	while($rows=mysqli_fetch_assoc($allSc)){
		$school = $rows['abbr'];
		$dept = $rows['department'];
	
		$ma = array();
		$totalA = 0;
		$totalP = 0;
		$totalB = 0;
		$totalPer = 0;
		$budget = 0;

		$allMa = mysqli_query($conn, "
			SELECT * FROM mustattend,mas_breakdown 
			WHERE mustattend.academicyear = '$ay' 
			AND mustattend.department = '$school' 
			AND mustattend.mas_id = mas_breakdown.mas_list_id
			ORDER BY title");
		if(mysqli_num_rows($allMa)!=0){
			while($rows=mysqli_fetch_assoc($allMa))
			{
				$masId = $rows['masid'];
				$checkAttended = mysqli_query($conn, "
					SELECT * FROM sem_emp
					INNER JOIN user_account
					ON sem_emp.email = user_account.email		
					WHERE sem_emp.attended = 'yes' 
					AND sem_emp.sem_id = '$masId' 
					");
				$attended = mysqli_num_rows($checkAttended);
				
				$numDean = $rows['numofdean'];
				$numChair = $rows['numofchair'];
				$numFac = $rows['numoffaculty'];
				$personsSem = $numDean+$numChair+$numFac;

				//mas budget
				$getMasBudget = mysqli_query($conn, "
					SELECT  mustattend.masid,mustattend.title, 
					
					$masComp

					mas_proposed.actual
					FROM mustattend 
					INNER JOIN masbreakdown
					ON mustattend.masid = masbreakdown.masid
		            INNER JOIN mas_proposed
		            ON mustattend.masid = mas_proposed.mas_id
					WHERE mustattend.masid = '$masId'
					");
				if(mysqli_num_rows($getMasBudget)!=0){
					while($rows=mysqli_fetch_assoc($getMasBudget))
					{
						$budget = $rows['budget'];
					}
				}


				$totalA += $attended;
				$totalP += $personsSem;
				$totalB += $budget;
				$attendees = $attended."/".$personsSem;
				$percentage = ($attended/$personsSem)*100;
				$ma[] = array(
					"title" => $rows['title'],
					"attended" => $attendees,
					"percentage" => $percentage."%",
					"budget" => number_format($budget,2,'.',', '),
					);
			}
		}else{
			$totalA = 0;
			$totalP = 0;
			$totalB = 0;
			$totalPer = 0;
			$ma = array();
			$ma[] = array(
				"title" => 'N/A',
				"attended" => 0,
				"percentage" => 0,
				"budget" => 0,
				);
		}

		if($totalP!=0){
			$totalPer = ($totalA/$totalP)*100;
		}else{
			$totalPer = "0/0";
		}

		$sc[] = array(
			"school" => $school,
			"department" => $dept,
			"totalBudget" => $totalB,
			"ay" => $ay,
			"totalPer" => round($totalPer,2),
			"totalAP" => $totalA.'/'.$totalP,
			"ma" => $ma
			);
	}

	// header('content-type: application/json');
	// echo json_encode($sc);

	$pdf = new PDF('L');
	$pdf->SetAutoPageBreak('auto',10);
	$pdf->SetFont('Arial','',11);
	$pdf->AddPage();
	$pdf->Cell(270,5,'Must-Attend Seminars',0,'','C');
	$pdf->Ln();
	$pdf->Cell(270,5,'AY '.$ay,0,'','C');
	$pdf->Ln();
	$pdf->Cell(270,5,'Summary Report of Attendance/Participation',0,'','C');
	$pdf->Ln();
	foreach($sc as $s){
		$pdf->Cell(270,10,$s['department'],0,'','C');
		$pdf->Ln();

		$pdf->SetLeftMargin(20);
		$pdf->BasicTable($s['ma']);

		$pdf->Cell(80,10,'Total',1);
		$pdf->Cell(60,10,$s['totalAP'],1);
		$pdf->Cell(60,10,$s['totalPer']."%",1);
		$pdf->Cell(60,10,number_format($s['totalBudget'],2,'.',', '),1,'','R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->AddPage();
	}
	$pdf->Output();
}

function perSeminar($masComp){
	
	$sc = array();
	$ay = '2016-2017';

	if(isset($_GET['dept'])){

		$getDept = $_GET['dept'];

			$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
				while($rows=mysqli_fetch_assoc($allSc)){
					$school = $rows['school'];
					$id = $rows['id'];
					$allBudget = 0;
					$allActual = 0;

					$college = array();
					$allC = mysqli_query($conn, "SELECT abbr,department FROM faith_department WHERE school_id = '$id' AND abbr = '$getDept' ");
					while($rows=mysqli_fetch_assoc($allC)){
						$dept = $rows['department'];
						$abbr = $rows['abbr'];

						$ma = array();
						$totalBudget = 0;
						$totalActual = 0;
						$getMasBudget = mysqli_query($conn, "
							SELECT  mustattend.mas_id,mustattend.title, 
								
							$masComp

							(mas_breakdown.numofdean + mas_breakdown.numofchair + mas_breakdown.numoffaculty)
							AS actual_persons,
							mas_proposed.actual, mustattend.venue, mustattend.dates
							FROM mustattend 
							INNER JOIN masbreakdown
							ON mustattend.mas_id = mas_breakdown.mas_list_id
				            INNER JOIN mas_proposed
				            ON mustattend.masid = mas_proposed.mas_id
							WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
							");



						$totalProposedCollege = 0;
						$totalActualCollege = 0;
						if(mysqli_num_rows($getMasBudget)!=0){
							while($rows=mysqli_fetch_assoc($getMasBudget))
							{
								$masid = $rows['masid'];
								$title = $rows['title'];
								$venue = $rows['venue'];
								$date = $rows['dates'];
								$actual_persons = $rows['actual_persons'];
								$budget = $rows['budget'];
								$actual = $rows['actual'];

								$getAttendees = mysqli_query($conn, "
									SELECT sem_emp.email,user_types.user AS position,sem_emp.attended, 
									CONCAT(user_profile.firstname,' ',user_profile.lastname) as name, 
									CONCAT(user_profile.dept_id, ' ',profile.designation) as position
									FROM sem_emp
									INNER JOIN user_account
									ON sem_emp.email = user_account.email
									INNER JOIN user_profile
									ON account.email = user_profile.email
									WHERE sem_id = '$masid' 
									INNER JOIN user_profile
									ON user_profile.dept_id = faith_department.id
								");
								$attendees = array();
								if(mysqli_num_rows($getAttendees)!=0){
									while($rows=mysqli_fetch_assoc($getAttendees))
									{

										$email = $rows['email'];
										$name = $rows['name'];
										$position = $rows['position'];
										$attended = $rows['attended'];
										//my budget

											$position = $_SESSION['user'];


										if($position=="dean"){
											$getMyBudget = mysqli_query($conn, "SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM mas_breakdown WHERE masid = '$masid'");
										}else if($position=="chair"){
											$getMyBudget = mysql_query("SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE mas_is_id = '$masid'");
										}else if($position=="faculty"){
											$getMyBudget = mysqli_query($conn, "SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM mas_breakdown WHERE mas_list_id = '$masid'");
										}else{
											echo "HOW?";
										}
										while($rows=mysqli_fetch_assoc($getMyBudget))
										{
											$my_budget = $rows['my_budget'];
										}

										$attendees[] = array(
											"name" => $name,
											"position" => $position,
											"email" => $email,
											"attended" => $attended,
											"my_budget" => $my_budget,
											);
									}
								}

								$totalBudget += $budget;
								$totalActual += $actual;

								$ma[] = array(
									"title" => $title,
									"venue" => $venue,
									"date" => $date,
									"budget" => $budget,
									"actual" => $actual,
									"actual_persons" => $actual_persons,
									"attendees" => $attendees
									);
							}
						}

							$totalProposedCollege += $totalBudget;
							$totalActualCollege += $totalActual;
							$college[] = array(
								"college" => $abbr,
								"totalProposedCollege" => $totalProposedCollege,
								"totalActualCollege" => $totalActualCollege,
								"ma" => $ma,
							);
						
							$allBudget += $totalBudget;
							$allActual += $totalActual;
					}

						$sc[] = array(
							"school" => $school,
							"totalProposedSchool" => $allBudget,
							"totalActualSchool" => $allActual,
							"college" => $college
							);
			}
		//}


		header('content-type: application/json');
		// echo json_encode($sc);	

		$rh = 8;
		// $rtr = 10;

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto',30);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->Cell(270,5,$dept,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'Detailed Report of Must-Attend Attendance/Participation',0,'','C');

		foreach($sc as $s){
			$pdf->Ln();
			foreach($s['college'] as $c){
					foreach($c['ma'] as $m){
						$pdf->Ln();
						$pdf->Cell(130,10,'Seminar Title: '.$m['title'],1);
						$pdf->Cell(70,10,'Venue: '.$m['venue'],1);
						$pdf->Cell(70,10,'Estimated Date: '.date('M d,Y',strtotime($m['date'])),1);
						$pdf->Ln();
						$pdf->Cell(270,10,'Attendees: '.count($m['attendees']).'/'.$m['actual_persons'],1);
						$pdf->Ln();
						$pdf->Cell(90,10,'Faculty',1);
						$pdf->Cell(90,10,'Position',1);
						$pdf->Cell(90,10,'Budget',1);
						$totalAttended = 0;
							foreach($m['attendees'] as $a){
								$pdf->Ln();
								$pdf->Cell(90,10,$a['name'],1);
								$pdf->Cell(90,10,ucwords($a['position']),1);
								$pdf->Cell(90,10,formatNumber($a['my_budget']),1,'','R');
							}
					}
			}
		}

		$pdf->SetFillColor(255,253,27);
		$pdf->Cell(90,15,'TOTAL',1,'','R',true);
		$pdf->Cell(90,15,'',1,'','R',true);
		$pdf->Cell(90,15,formatNumber($s['totalProposedSchool']),1,'','R',true);
		$pdf->Ln();
		$pdf->Output();

	}else{
			$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
				while($rows=mysqli_fetch_assoc($allSc)){
					$school = $rows['school'];
					$id = $rows['id'];
					$allBudget = 0;
					$allActual = 0;

					$college = array();
					$allC = mysqli_query($conn, "SELECT abbr,department FROM faith_department WHERE school_id = '$id' ");
					while($rows=mysqli_fetch_assoc($allC)){
						$dept = $rows['department'];
						$abbr = $rows['abbr'];

						$ma = array();
						$totalBudget = 0;
						$totalActual = 0;
						$getMasBudget = mysqli_query($conn, "
							SELECT  mustattend.mas_id,mustattend.title, 
								
							$masComp

							(mas_breakdown.numofdean + mas_breakdown.numofchair + mas_breakdown.numoffaculty)
							AS actual_persons,
							mas_proposed.actual, mustattend.venue, mustattend.dates
							FROM mustattend 
							INNER JOIN masbreakdown
							ON mustattend.mas_id = masbreakdown.mas_list_id
				            INNER JOIN mas_proposed
				            ON mustattend.mas_id = mas_proposed.mas_id
							WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
							");



						$totalProposedCollege = 0;
						$totalActualCollege = 0;
						if(mysqli_num_rows($getMasBudget)!=0){
							while($rows=mysql_fetch_assoc($getMasBudget))
							{
								$masid = $rows['mas_id'];
								$title = $rows['title'];
								$venue = $rows['venue'];
								$date = $rows['dates'];
								$actual_persons = $rows['actual_persons'];
								$budget = $rows['budget'];
								$actual = $rows['actual'];

								$getAttendees = mysqli_query($conn, "
									SELECT sem_emp.email, user_type.user AS position,sem_emp.attended, 
									CONCAT(user_profile.firstname,' ',user_profile.lastname) as name, 
									CONCAT(user_profile.college, ' ',user_profile.designation) as position
									FROM sem_emp
									INNER JOIN user_account
									ON sem_emp.email = user_account.email
									INNER JOIN user_profile
									ON user_account.email = user_profile.email
									WHERE sem_id = '$masid'
								");
								$attendees = array();
								if(mysqli_num_rows($getAttendees)!=0){
									while($rows=mysqli_fetch_assoc($getAttendees))
									{

										$email = $rows['email'];
										$name = $rows['name'];
										$position = $rows['position'];
										$attended = $rows['attended'];

											$position = $_SESSION['user'];

										if($position=="dean"){
											$getMyBudget = mysqli_query($conn, "SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM mas_breakdown WHERE mas_list_id = '$masid'");
										}else if($position=="chair"){
											$getMyBudget = mysqli_query($conn, "SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM mas_breakdown WHERE mas_list_id = '$masid'");
										}else if($position=="faculty"){
											$getMyBudget = mysqli_query($conn, "SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM mas_breakdown WHERE mas_list_id = '$masid'");
										}else{
											echo "HOW?";
										}
										while($rows=mysqli_fetch_assoc($getMyBudget))
										{
											$my_budget = $rows['my_budget'];
										}

										$attendees[] = array(
											"name" => $name,
											"position" => $position,
											"email" => $email,
											"attended" => $attended,
											"my_budget" => $my_budget,
											);
									}
								}

								$totalBudget += $budget;
								$totalActual += $actual;

								$ma[] = array(
									"title" => $title,
									"venue" => $venue,
									"date" => $date,
									"budget" => $budget,
									"actual" => $actual,
									"actual_persons" => $actual_persons,
									"attendees" => $attendees
									);
							}
						}

							$totalProposedCollege += $totalBudget;
							$totalActualCollege += $totalActual;
							$college[] = array(
								"college" => $abbr,
								"totalProposedCollege" => $totalProposedCollege,
								"totalActualCollege" => $totalActualCollege,
								"ma" => $ma,
							);
						
							$allBudget += $totalBudget;
							$allActual += $totalActual;
					}

						$sc[] = array(
							"school" => $school,
							"totalProposedSchool" => $allBudget,
							"totalActualSchool" => $allActual,
							"college" => $college
							);
			}
		//}


		header('content-type: application/json');
		// echo json_encode($sc);	

		$rh = 8;
		// $rtr = 10;

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto',30);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->Cell(270,5,'Tertiary Schools',0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'Detailed Report of Must-Attend Attendance/Participation',0,'','C');
		foreach($sc as $s){
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFillColor(200,200,200);
			$pdf->Cell(270,$rh,$s['school'],1,'','C',true);
			$pdf->Ln();
			foreach($s['college'] as $c){
				$pdf->Cell(270,$rh,$c['college'],1,'','C');
					foreach($c['ma'] as $m){
						$pdf->Ln();
						$pdf->Cell(130,10,'Seminar Title: '.$m['title'],1);
						$pdf->Cell(70,10,'Venue: '.$m['venue'],1);
						$pdf->Cell(70,10,'Estimated Date: '.date('M d,Y',strtotime($m['date'])),1);
						$pdf->Ln();
						$pdf->Cell(270,10,'Attendees: '.count($m['attendees']).'/'.$m['actual_persons'],1);
						$pdf->Ln();
						$pdf->Cell(90,10,'Faculty',1);
						$pdf->Cell(90,10,'Position',1);
						$pdf->Cell(90,10,'Budget',1);
						$totalAttended = 0;
							foreach($m['attendees'] as $a){
								$pdf->Ln();
								$pdf->Cell(90,10,$a['name'],1);
								$pdf->Cell(90,10,ucwords($a['position']),1);
								$pdf->Cell(90,10,formatNumber($a['my_budget']),1,'','R');
							}
					}
					$pdf->Ln();
					$pdf->SetFillColor(251,255,142);
					$pdf->Cell(90,10,'Subtotal',1,'','R',true);
					$pdf->Cell(90,10,'',1,'','R',true);
					$pdf->Cell(90,10,formatNumber($c['totalProposedCollege']),1,'','R',true);
					$pdf->Ln();
			}
			// $pdf->SetFont('Arial','B',15);
			$pdf->SetFillColor(255,253,27);
			$pdf->Cell(90,15,'TOTAL',1,'','R',true);
			$pdf->Cell(90,15,'',1,'','R',true);
			$pdf->Cell(90,15,formatNumber($s['totalProposedSchool']),1,'','R',true);
			$pdf->Ln();
		}
		// $pdf->Ln();
		// $pdf->SetFont('Arial','B',17);
		// $pdf->Cell(80,10,'Total','','','R');
		// $pdf->Cell(60,10,'');
		// $pdf->Cell(60,10,'');
		// $pdf->Cell(60,10,number_format($scBudget,2,'.',', '));
		// $pdf->AddPage();
		$pdf->Output();
	}
}

//1
function perCollege2(){
	$fs = 18;
	$cw = 60;

	$ay = '2016-2017';

	if(isset($_GET['dept'])){
		$getDept = $_GET['dept'];

		$sc = array();
		$superAllA = 0;
		$superAllP = 0;
		$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
			while($rows=mysqli_fetch_assoc($allSc)){
				$school = $rows['school'];
				$id = $rows['id'];

				$college = array();
				$allA = 0;
				$allP = 0;

				$allC = mysqli_query($conn, "SELECT abbr,department FROM faith_department WHERE school_id = '$id' AND abbr='$getDept' ");
				while($rows=mysqli_fetch_assoc($allC)){
					$dept = $rows['department'];
					$abbr = $rows['abbr'];

					$allMa = mysqli_query($conn, "SELECT * FROM mustattend WHERE academicyear = '$ay' AND department = '$abbr' ORDER BY title");
					if(mysqli_num_rows($allMa)!=0){
						$ma = array();
						$totalA = 0;
						$totalP = 0;
						$totalB = 0;
						$totalPer = 0;
						while($rows=mysqli_fetch_assoc($allMa))
						{
							$masId = $rows['masid'];
							$checkAttended = mysqli_query($conn, "
								SELECT * FROM sem_emp
								INNER JOIN user_account
								ON sem_emp.email = user_account.email		
								WHERE sem_emp.attended = 'yes' 
								AND sem_emp.sem_id = '$masId' 
								");
							$attended = mysqli_num_rows($checkAttended);

							$maDetails = mysqli_query($conn, "
								SELECT * FROM mustattend 
								INNER JOIN mas_breakdown
								ON mustattend.mas_id = masbreakdown.mas_list_id
								WHERE mustattend.mas_id='$masId'
								");

							if(mysqli_num_rows($maDetails)!=0){
								while($rows=mysqli_fetch_assoc($maDetails))
								{	
									$numDean = $rows['numofdean'];
									$numChair = $rows['numofchair'];
									$numFac = $rows['numoffaculty'];
									$persons = $numDean+$numChair+$numFac;

									$totalA += $attended;
									$totalP += $persons;
									$totalB += $rows['budget'];
									$attendees = $attended."/".$persons;
									$percentage = ($attended/$persons)*100;
									$ma[] = array(
										"title" => $rows['title'],
										"attended" => $attendees,
										"percentage" => $percentage."%",
										"budget" => number_format($rows['budget'],2,'.',', '),
										);

								}
							}
						}
					}else{
						$totalA = 0;
						$totalP = 0;
						$totalB = 0;
						$totalPer = 0;
					}

					if($totalP!=0){
						$totalPer = ($totalA/$totalP)*100;
					}else{
						$totalPer = "0/0";
					}


					$college[] = array(
						"college" => $abbr,
						"department" => $dept,
						"totalBudget" => $totalB,
						"ay" => $ay,
						"totalPer" => round($totalPer,2),
						"totalA" => $totalA,
						"totalP" => $totalP,
						);

						$allA += $totalA;
						$allP += $totalP;
				}

					$sc[] = array(
						"school" => $school,
						"allA" => $allA,
						"allP" => $allP,
						"college" => $college
						);

					$superAllA += $allA;
					$superAllP += $allP;
			}

			// header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = 60;
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',30);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,5,$dept,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,5,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,5,'Comparative Report of Must-Attend Seminars',0,'','C');
			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetLeftMargin(30);
		    $pdf->Cell($cellW+60,$cellH,'Proposed MAS',1,'','C');
		    $pdf->Cell($cellW+60,$cellH,'Accomplishments',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Ln();
		    foreach($sc as $s)
		    {
		    	$tsAll = 0;
		    	
		    	foreach($s['college'] as $c){

		    		if($superAllP!=0){
			    		$perP = ($c['totalP']/$superAllP)*100;
		    		}else{
		    			$perP = 0;
		    		}


			    	if($c['totalP']!=0){
			    		$perA = ($c['totalA']/$c['totalP'])*100;
					}else{
						$perA = 0;
					}

					if($c['totalP']!=0){
						$perCollege = "100%";
					}else{
						$perCollege = "0%";
					}
				    $pdf->Cell($cellW,$cellH,round($c['totalP'],2),1,'','R');
				    $pdf->Cell($cellW,$cellH,$perCollege,1,'','R');
				    $pdf->Cell($cellW,$cellH,$c['totalA'],1,'','R');
				    $pdf->Cell($cellW,$cellH,round($perA,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    	if($s['allP']!=0){
		    		$tsAll = ($s['allA']/$s['allP'])*100;
		    	}

		    }


			$pdf->Output();
	}else{

		$sc = array();
		$superAllA = 0;
		$superAllP = 0;
		$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
			while($rows=mysqli_fetch_assoc($allSc)){
				$school = $rows['school'];
				$id = $rows['id'];

				$college = array();
				$allA = 0;
				$allP = 0;

				$allC = mysqli_query($conn, "SELECT abbr,department FROM faith_department WHERE school_id = '$id' ");
				while($rows=mysqli_fetch_assoc($allC)){
					$dept = $rows['department'];
					$abbr = $rows['abbr'];

					$allMa = mysqli_query("SELECT * FROM mustattend WHERE academicyear = '$ay' AND department = '$abbr' ORDER BY title");
					if(mysqli_num_rows($allMa)!=0){
						$ma = array();
						$totalA = 0;
						$totalP = 0;
						$totalB = 0;
						$totalPer = 0;
						while($rows=mysqli_fetch_assoc($allMa))
						{
							$masId = $rows['mas_id'];
							$checkAttended = mysqli_query($conn, "
								SELECT * FROM sem_emp
								INNER JOIN user_account
								ON sem_emp.email = user_account.email		
								WHERE sem_emp.attended = 'yes' 
								AND sem_emp.sem_id = '$masId' 
								");
							$attended = mysqli_num_rows($checkAttended);

							$maDetails = mysqli_query($conn, "SELECT * FROM mas_breakdown INNER JOIN mustattend ON mustattend.mas_id = mas_breakdown.mas_list_id WHERE mustattend.mas_id='$masId'");

							if(mysqli_num_rows($maDetails)!=0){
								($rows=mysqli_fetch_assoc($maDetails))
								{	
									$numDean = $rows['numofdean'];
									$numChair = $rows['numofchair'];
									$numFac = $rows['numoffaculty'];
									$persons = $numDean+$numChair+$numFac;

									$totalA += $attended;
									$totalP += $persons;
									$totalB += $rows['budget'];
									$attendees = $attended."/".$persons;
									$percentage = ($attended/$persons)*100;
									$ma[] = array(
										"title" => $rows['title'],
										"attended" => $attendees,
										"percentage" => $percentage."%",
										"budget" => number_format($rows['budget'],2,'.',', '),
										);
								}
							}
						}
					}else{
						$totalA = 0;
						$totalP = 0;
						$totalB = 0;
						$totalPer = 0;
					}

					if($totalP!=0){
						$totalPer = ($totalA/$totalP)*100;
					}else{
						$totalPer = "0/0";
					}


					$college[] = array(
						"college" => $abbr,
						"department" => $dept,
						"totalBudget" => $totalB,
						"ay" => $ay,
						"totalPer" => round($totalPer,2),
						"totalA" => $totalA,
						"totalP" => $totalP,
						);

						$allA += $totalA;
						$allP += $totalP;
				}

					$sc[] = array(
						"school" => $school,
						"allA" => $allA,
						"allP" => $allP,
						"college" => $college
						);

					$superAllA += $allA;
					$superAllP += $allP;
			}

			// header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = 40;
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',30);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,5,'Tertiary Schools',0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,5,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,5,'Comparative Report of Must-Attend Seminars',0,'','C');
			$pdf->Ln();
			$pdf->Ln();

			$pdf->SetLeftMargin(30);
		    $pdf->Cell($cellW+40,$cellH,'','TL');
		    $pdf->Cell($cellW+40,$cellH,'Proposed MAS',1,'','C');
		    $pdf->Cell($cellW+40,$cellH,'Accomplishments',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell($cellW+40,$cellH,'College','LRB','','C');
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Ln();
		    foreach($sc as $s)
		    {
		    	$tsAll = 0;
		    	$tsPerCollege = 0;
		    	$short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
		    	$pdf->SetFillColor(200,200,200);
		    	$pdf->Cell($cellW+200,$cellH,$short,1,'','C',true);
		    	$pdf->Ln();
		    	
		    	foreach($s['college'] as $c){
		    		if($superAllP!=0){
			    		$perP = ($c['totalP']/$superAllP)*100;
		    		}else{
		    			$perP = 0;
		    		}


			    	if($c['totalP']!=0){
			    		$perA = ($c['totalA']/$c['totalP'])*100;
					}else{
						$perA = 0;
					}

					if($c['totalP']!=0){
						$perCollege = 100;
					}else{
						$perCollege = 0;
					}

					$tsPerCollege += $perCollege;
					// echo $c['totalP'];
				    $pdf->Cell(80,$cellH,$c['college'],1,'','L');
				    $pdf->Cell($cellW,$cellH,round($c['totalP'],2),1,'','R');
				    $pdf->Cell($cellW,$cellH,$perCollege.'%',1,'','R');
				    $pdf->Cell($cellW,$cellH,$c['totalA'],1,'','R');
				    $pdf->Cell($cellW,$cellH,round($perA,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    	if($s['allP']!=0){
		    		$tsAll = ($s['allA']/$s['allP'])*100;
		    	}

		    	if($tsPerCollege!=0){
		    		$tsPerCollegeVal = 100;
		    	}else{
		    		$tsPerCollegeVal = 0;
		    	}

			    $pdf->Cell(80,$cellH,'Subtotal',1,'','R');
			    $pdf->Cell($cellW,$cellH,round($s['allP'],2),1,'','R');
			    $pdf->Cell($cellW,$cellH,$tsPerCollegeVal.'%',1,'','R');
			    $pdf->Cell($cellW,$cellH,$s['allA'],1,'','R');
			    $pdf->Cell($cellW,$cellH,round($tsAll,2).'%',1,'','R');
			    $pdf->Ln();

		    }
		    	if($perAll!=0){
		    		$perAll = ($superAllA/$superAllP)*100;
		    	}else{
		    		$perAll = 0;
		    	}

			    $pdf->Cell(80,$cellH,'Total',1,'','R');
			    $pdf->Cell($cellW,$cellH,round($superAllP,2),1,'','R');
			    $pdf->Cell($cellW,$cellH,'100%',1,'','R');
			    $pdf->Cell($cellW,$cellH,$superAllA,1,'','R');
			    $pdf->Cell($cellW,$cellH,round($perAll,2).'%',1,'','R');


			$pdf->Output();
	}
}

function compBudget($masComp){
	$fs = 18;
	$cw = 60;

	$sc = array();
	$ay = '2016-2017';

	if(isset($_GET['dept'])){
		$getDept = $_GET['dept'];

		$allSc = mysql_query("SELECT id,school FROM faith_school");
			while($rows=mysql_fetch_assoc($allSc)){
				$school = $rows['school'];
				$id = $rows['id'];

				//mas
				$allBudget = 0;
				$allActual = 0;
				///othermas
				$allBudgetOther = 0;
				$allActualOther = 0;

				$college = array();
				$allC = mysql_query("SELECT abbr,department FROM faith_department WHERE school_id = '$id' AND abbr = '$getDept' ");
				while($rows=mysql_fetch_assoc($allC)){
					$dept = $rows['department'];
					$abbr = $rows['abbr'];

					//mas
					$ma = array();
					$totalBudget = 0;
					$totalActual = 0;
					//othermas
					$otherma = array();
					$totalBudgetOther = 0;
					$totalActualOther = 0;

					$totalProposedCollege = 0;
					$totalActualCollege = 0;

					$totalProposedCollegeOther = 0;
					$totalActualCollegeOther = 0;

					//mas
					$getMasBudget = mysql_query("
						SELECT  mustattend.masid,mustattend.title, 
						
						$masComp

						mas_proposed.actual
						FROM mustattend 
						INNER JOIN masbreakdown
						ON mustattend.masid = masbreakdown.masid
			            INNER JOIN mas_proposed
			            ON mustattend.masid = mas_proposed.mas_id
						WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
						");
					if(mysql_num_rows($getMasBudget)!=0){
						while($rows=mysql_fetch_assoc($getMasBudget))
						{
							$masid = $rows['masid'];
							$title = $rows['title'];
							$budget = $rows['budget'];
							$actual = $rows['actual'];

							$getAttendees = mysql_query("
								SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
								FROM sem_emp, account 
								WHERE attended = 'yes' 
								AND sem_id = '$masid' 
								AND sem_emp.email = account.email
							");
							$attendees = array();
							if(mysql_num_rows($getAttendees)!=0){
								while($rows=mysql_fetch_assoc($getAttendees))
								{
									$attendees[] = array(
										"email" => $rows['email'],
										"position" => $rows['position'],
										"attended" => $rows['attended']
										);
								}
							}

							$totalBudget += $budget;
							$totalActual += $actual;


							$ma[] = array(
								"title" => $title,
								"budget" => $budget,
								"actual" => $actual,
								"attendees" => $attendees
								);
						}
					}

					//othermas
					$getOtherMasBudget = mysql_query("
						SELECT  othersem.otherSem_id,othersem.title, 
						
						(
							(othersembreakdown.deanHotel * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairHotel * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyHotel * 
						    					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)  
						    )
						+
							(othersembreakdown.deanDiem * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						+
							(othersembreakdown.regDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )
						 
						+
							(othersembreakdown.transpoDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						) AS budget,

						othersem_proposed.actual
						FROM othersem 
						INNER JOIN othersembreakdown
						ON othersem.otherSem_id = othersembreakdown.otherSem_id
			            INNER JOIN othersem_proposed
			            ON othersem.otherSem_id = othersem_proposed.othersem_id
						WHERE othersem.department = '$abbr' AND othersem.academicyear = '$ay'
						");
					if(mysql_num_rows($getOtherMasBudget)!=0){
						while($rows=mysql_fetch_assoc($getOtherMasBudget))
						{
							$othersem_id = $rows['otherSem_id'];
							$title = $rows['title'];
							$otherbudget = $rows['budget'];
							$otheractual = $rows['actual'];

							$getAttendees = mysql_query("
								SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
								FROM sem_emp, account 
								WHERE attended = 'yes' 
								AND sem_id = '$othersem_id' 
								AND sem_emp.email = account.email
							");
							$attendees = array();
							if(mysql_num_rows($getAttendees)!=0){
								while($rows=mysql_fetch_assoc($getAttendees))
								{
									$attendees[] = array(
										"email" => $rows['email'],
										"position" => $rows['position'],
										"attended" => $rows['attended']
										);
								}
							}

							$totalBudgetOther += $otherbudget;
							$totalActualOther += $otheractual;


							$otherma[] = array(
								"title" => $title,
								"budget" => $otherbudget,
								"actual" => $otheractual,
								"attendees" => $attendees
								);
						}
					}

					//mas
					$totalProposedCollege += $totalBudget;
					$totalActualCollege += $totalActual;
					//othermas
					$totalProposedCollegeOther += $totalBudgetOther;
					$totalActualCollegeOther += $totalActualOther;

					$college[] = array(
						"college" => $abbr,
						"totalProposedCollege" => $totalProposedCollege,
						"totalActualCollege" => $totalActualCollege,
						"totalProposedCollegeOther" => $totalProposedCollegeOther,
						"totalActualCollegeOther" => $totalActualCollegeOther,
						"ma" => $ma,
					);
					
					//mas
					$allBudget += $totalBudget;
					$allActual += $totalActual;
					//othermas
					$allBudgetOther += $totalBudgetOther;
					$allActualOther += $totalActualOther;
				}

			$sc[] = array(
				"school" => $school,
				"totalProposedSchool" => $allBudget,
				"totalActualSchool" => $allActual,
				"totalProposedSchoolOther" => $allBudgetOther,
				"totalActualSchoolOther" => $allActualOther,
				"college" => $college
				);
		}

			header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = "";
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',30);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,10,$dept,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,10,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,10,'Comparative Analysis on Budget of Must-Attend Seminars',0,'','C');

		    $pdf->Ln();
		    $pdf->Cell(105,$cellH,'Proposed Budget',1,'','C');
		    $pdf->Cell(105,$cellH,'Actual Budget',1,'','C');
		    $pdf->Cell(35,$cellH,'Var',1,'','C');
		    $pdf->Cell(30,$cellH,'%',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell(35,$cellH,'MAS',1,'','C');
		    $pdf->Cell(35,$cellH,'Others',1,'','C');
		    $pdf->Cell(35,$cellH,'Total',1,'','C');
		    $pdf->Cell(35,$cellH,'MAS',1,'','C');
		    $pdf->Cell(35,$cellH,'Others',1,'','C');
		    $pdf->Cell(35,$cellH,'Total',1,'','C');
		    $pdf->Cell(35,$cellH,'',1,'','C');
		    $pdf->Cell(30,$cellH,'',1,'','C');
		    $pdf->Ln();

			$superAllProposed = 0;
			$superAllActual = 0;

			$superAllProposedOther = 0;
			$superAllActualOther = 0;
			$superAllTotalProposed = 0;
			$superAllTotalActual = 0;

		    foreach($sc as $s)
		    {
		    	$totalProposedSchool = $s['totalProposedSchool'];
		    	$totalActualSchool = $s['totalActualSchool'];
		    	$totalVarianceSchool = $totalProposedSchool - $totalActualSchool;
		    	
		    	$totalVarianceCollege = 0;
		    	$superDuperTotalProposedCollege = 0;
		    	$superDuperTotalActualCollege = 0;
		    	$perCollege = 0;
		    	foreach($s['college'] as $c){
		    		$totalActualCollege = $c['totalActualCollege'];
		    		$totalProposedCollege = $c['totalProposedCollege'];
		    		$totalActualCollegeOther = $c['totalActualCollegeOther'];
		    		$totalProposedCollegeOther = $c['totalProposedCollegeOther'];


		    		$superTotalProposedCollege = $totalProposedCollege + $totalProposedCollegeOther;
		    		$superTotalActualCollege = $totalActualCollege + $totalActualCollegeOther;

		    		$superDuperTotalProposedCollege += $superTotalProposedCollege;
		    		$superDuperTotalActualCollege += $superTotalActualCollege;

		    		if($superTotalProposedCollege!=0){
		    			$perCollege = ($superTotalActualCollege/$superTotalProposedCollege)*100;
		    		}else{
		    			$perCollege = 0;
		    		}

		    		if($perCollege>100){
		    			$perCollege = ($perCollege-100)*-1;	
		    		}

		    		$totalVarianceCollege = $superTotalProposedCollege - $superTotalActualCollege;
				    $pdf->Cell(35,$cellH,formatNumber($totalProposedCollege),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($totalProposedCollegeOther),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($superTotalProposedCollege),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($totalActualCollege),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($totalActualCollegeOther),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($superTotalActualCollege),1,'','R');
				    $pdf->Cell(35,$cellH,formatNumber($totalVarianceCollege),1,'','R');
				    $pdf->Cell(30,$cellH,round($perCollege,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    	$schoolVariance = $superDuperTotalProposedCollege - $superDuperTotalActualCollege;

		    	if($superDuperTotalProposedCollege!=0){
		    		$perSchool = ($superDuperTotalActualCollege/$superDuperTotalProposedCollege)*100;
		    	}else{
		    		$perSchool = 0;
		    	}

		    	if($perSchool>100){
		    		$perSchool = ($perSchool-100)*-1;	
		    	}

		    	$superAllProposed += $totalProposedSchool;
		    	$superAllActual += $totalActualSchool;

		    	$superAllProposedOther += $s['totalProposedSchoolOther'];
		    	$superAllActualOther += $s['totalActualSchoolOther'];

		    	$superAllTotalProposed += $superDuperTotalProposedCollege;
		    	$superAllTotalActual += $superDuperTotalActualCollege;
		    }

		    	if($superAllProposed!=0){
		    		$perAll = ($superAllActual/$superAllProposed)*100;
		    	}else{
		    		$perAll = 0;
		    	}
		    	$superVariance = $superAllProposed - $superAllActual;
		    	if($perAll>100){
		    		$perAll = ($perAll-100)*-1;
		    	}
		    	//add a condition if this variance is negative
		    	//turn into absolute then subtract again


			$pdf->Output();

	}else{

		$allSc = mysql_query("SELECT id,school FROM faith_school");
			while($rows=mysql_fetch_assoc($allSc)){
				$school = $rows['school'];
				$id = $rows['id'];

				//mas
				$allBudget = 0;
				$allActual = 0;
				///othermas
				$allBudgetOther = 0;
				$allActualOther = 0;

				$college = array();
				$allC = mysql_query("SELECT abbr,department FROM faith_department WHERE school_id = '$id' ");
				while($rows=mysql_fetch_assoc($allC)){
					$dept = $rows['department'];
					$abbr = $rows['abbr'];


					
					//mas
					$ma = array();
					$totalBudget = 0;
					$totalActual = 0;
					//othermas
					$otherma = array();
					$totalBudgetOther = 0;
					$totalActualOther = 0;

					$totalProposedCollege = 0;
					$totalActualCollege = 0;

					$totalProposedCollegeOther = 0;
					$totalActualCollegeOther = 0;

					//mas
					$getMasBudget = mysql_query("
						SELECT  mustattend.masid,mustattend.title, 
						
						$masComp

						mas_proposed.actual
						FROM mustattend 
						INNER JOIN masbreakdown
						ON mustattend.masid = masbreakdown.masid
			            INNER JOIN mas_proposed
			            ON mustattend.masid = mas_proposed.mas_id
						WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
						");
					if(mysql_num_rows($getMasBudget)!=0){
						while($rows=mysql_fetch_assoc($getMasBudget))
						{
							$masid = $rows['masid'];
							$title = $rows['title'];
							$budget = $rows['budget'];
							$actual = $rows['actual'];

							$getAttendees = mysql_query("
								SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
								FROM sem_emp, account 
								WHERE attended = 'yes' 
								AND sem_id = '$masid' 
								AND sem_emp.email = account.email
							");
							$attendees = array();
							if(mysql_num_rows($getAttendees)!=0){
								while($rows=mysql_fetch_assoc($getAttendees))
								{
									$attendees[] = array(
										"email" => $rows['email'],
										"position" => $rows['position'],
										"attended" => $rows['attended']
										);
								}
							}

							$totalBudget += $budget;
							$totalActual += $actual;


							$ma[] = array(
								"title" => $title,
								"budget" => $budget,
								"actual" => $actual,
								"attendees" => $attendees
								);
						}
					}

					//othermas
					$getOtherMasBudget = mysql_query("
						SELECT  othersem.otherSem_id,othersem.title, 
						
						(
							(othersembreakdown.deanHotel * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairHotel * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyHotel * 
						    					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)  
						    )
						+
							(othersembreakdown.deanDiem * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						+
							(othersembreakdown.regDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )
						 
						+
							(othersembreakdown.transpoDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						) AS budget,

						othersem_proposed.actual
						FROM othersem 
						INNER JOIN othersembreakdown
						ON othersem.otherSem_id = othersembreakdown.otherSem_id
			            INNER JOIN othersem_proposed
			            ON othersem.otherSem_id = othersem_proposed.othersem_id
						WHERE othersem.department = '$abbr' AND othersem.academicyear = '$ay'
						");
					if(mysql_num_rows($getOtherMasBudget)!=0){
						while($rows=mysql_fetch_assoc($getOtherMasBudget))
						{
							$othersem_id = $rows['otherSem_id'];
							$title = $rows['title'];
							$otherbudget = $rows['budget'];
							$otheractual = $rows['actual'];

							$getAttendees = mysql_query("
								SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
								FROM sem_emp, account 
								WHERE attended = 'yes' 
								AND sem_id = '$othersem_id' 
								AND sem_emp.email = account.email
							");
							$attendees = array();
							if(mysql_num_rows($getAttendees)!=0){
								while($rows=mysql_fetch_assoc($getAttendees))
								{
									$attendees[] = array(
										"email" => $rows['email'],
										"position" => $rows['position'],
										"attended" => $rows['attended']
										);
								}
							}

							$totalBudgetOther += $otherbudget;
							$totalActualOther += $otheractual;


							$otherma[] = array(
								"title" => $title,
								"budget" => $otherbudget,
								"actual" => $otheractual,
								"attendees" => $attendees
								);
						}
					}

					//mas
					$totalProposedCollege += $totalBudget;
					$totalActualCollege += $totalActual;
					//othermas
					$totalProposedCollegeOther += $totalBudgetOther;
					$totalActualCollegeOther += $totalActualOther;

					$college[] = array(
						"college" => $abbr,
						"totalProposedCollege" => $totalProposedCollege,
						"totalActualCollege" => $totalActualCollege,
						"totalProposedCollegeOther" => $totalProposedCollegeOther,
						"totalActualCollegeOther" => $totalActualCollegeOther,
						"ma" => $ma,
					);
					
					//mas
					$allBudget += $totalBudget;
					$allActual += $totalActual;
					//othermas
					$allBudgetOther += $totalBudgetOther;
					$allActualOther += $totalActualOther;
				}

			$sc[] = array(
				"school" => $school,
				"totalProposedSchool" => $allBudget,
				"totalActualSchool" => $allActual,
				"totalProposedSchoolOther" => $allBudgetOther,
				"totalActualSchoolOther" => $allActualOther,
				"college" => $college
				);
		}

			header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = "";
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',30);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,10,'Tertiary Schools',0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,10,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,10,'Comparative Analysis on Budget of Must-Attend Seminars',0,'','C');

		    $pdf->Ln();
		    $pdf->Cell(40,$cellH,'College',1,'','C');
		    $pdf->Cell(90,$cellH,'Proposed Budget',1,'','C');
		    $pdf->Cell(90,$cellH,'Actual Budget',1,'','C');
		    $pdf->Cell(30,$cellH,'Var',1,'','C');
		    $pdf->Cell(25,$cellH,'%',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell(40,$cellH,'',1,'','C');
		    $pdf->Cell(30,$cellH,'MAS',1,'','C');
		    $pdf->Cell(30,$cellH,'Others',1,'','C');
		    $pdf->Cell(30,$cellH,'Total',1,'','C');
		    $pdf->Cell(30,$cellH,'MAS',1,'','C');
		    $pdf->Cell(30,$cellH,'Others',1,'','C');
		    $pdf->Cell(30,$cellH,'Total',1,'','C');
		    $pdf->Cell(30,$cellH,'',1,'','C');
		    $pdf->Cell(25,$cellH,'',1,'','C');
		    $pdf->Ln();

			$superAllProposed = 0;
			$superAllActual = 0;

			$superAllProposedOther = 0;
			$superAllActualOther = 0;
			$superAllTotalProposed = 0;
			$superAllTotalActual = 0;

		    foreach($sc as $s)
		    {
		    	$totalProposedSchool = $s['totalProposedSchool'];
		    	$totalActualSchool = $s['totalActualSchool'];
		    	$totalVarianceSchool = $totalProposedSchool - $totalActualSchool;

		    	$short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
		    	$pdf->SetFillColor(200,200,200);
		    	$pdf->Cell(275,10,$short,1,'','C',true);
		    	$pdf->Ln();
		    	
		    	$totalVarianceCollege = 0;
		    	$superDuperTotalProposedCollege = 0;
		    	$superDuperTotalActualCollege = 0;
		    	$perCollege = 0;
		    	foreach($s['college'] as $c){
		    		$totalActualCollege = $c['totalActualCollege'];
		    		$totalProposedCollege = $c['totalProposedCollege'];
		    		$totalActualCollegeOther = $c['totalActualCollegeOther'];
		    		$totalProposedCollegeOther = $c['totalProposedCollegeOther'];


		    		$superTotalProposedCollege = $totalProposedCollege + $totalProposedCollegeOther;
		    		$superTotalActualCollege = $totalActualCollege + $totalActualCollegeOther;

		    		$superDuperTotalProposedCollege += $superTotalProposedCollege;
		    		$superDuperTotalActualCollege += $superTotalActualCollege;

		    		if($superTotalProposedCollege!=0){
		    			$perCollege = ($superTotalActualCollege/$superTotalProposedCollege)*100;
		    		}else{
		    			$perCollege = 0;
		    		}

		    		if($perCollege>100){
		    			$perCollege = ($perCollege-100)*-1;	
		    		}

		    		$totalVarianceCollege = $superTotalProposedCollege - $superTotalActualCollege;
				    $pdf->Cell(40,$cellH,$c['college'],1,'','L');
				    $pdf->Cell(30,$cellH,formatNumber($totalProposedCollege),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($totalProposedCollegeOther),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($superTotalProposedCollege),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($totalActualCollege),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($totalActualCollegeOther),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($superTotalActualCollege),1,'','R');
				    $pdf->Cell(30,$cellH,formatNumber($totalVarianceCollege),1,'','R');
				    $pdf->Cell(25,$cellH,round($perCollege,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    	$schoolVariance = $superDuperTotalProposedCollege - $superDuperTotalActualCollege;

		    	if($superDuperTotalProposedCollege!=0){
		    		$perSchool = ($superDuperTotalActualCollege/$superDuperTotalProposedCollege)*100;
		    	}else{
		    		$perSchool = 0;
		    	}

		    	if($perSchool>100){
		    		$perSchool = ($perSchool-100)*-1;	
		    	}

		    	$pdf->Cell(40,$cellH,'Subtotal',1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($s['totalProposedSchool']),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($s['totalProposedSchoolOther']),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($superDuperTotalProposedCollege),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($s['totalActualSchool']),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($s['totalActualSchoolOther']),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($superDuperTotalActualCollege),1,'','R');
		    	$pdf->Cell(30,$cellH,formatNumber($schoolVariance),1,'','R');
		    	$pdf->Cell(25,$cellH,round($perSchool,2).'%',1,'','R');
			    $pdf->Ln();

		    	$superAllProposed += $totalProposedSchool;
		    	$superAllActual += $totalActualSchool;

		    	$superAllProposedOther += $s['totalProposedSchoolOther'];
		    	$superAllActualOther += $s['totalActualSchoolOther'];

		    	$superAllTotalProposed += $superDuperTotalProposedCollege;
		    	$superAllTotalActual += $superDuperTotalActualCollege;
		    }

		    	if($superAllProposed!=0){
		    		$perAll = ($superAllActual/$superAllProposed)*100;
		    	}else{
		    		$perAll = 0;
		    	}
		    	$superVariance = $superAllProposed - $superAllActual;
		    	if($perAll>100){
		    		$perAll = ($perAll-100)*-1;
		    	}
		    	//add a condition if this variance is negative
		    	//turn into absolute then subtract again

			    $pdf->Cell(40,$cellH,'TOTAL',1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllProposed),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllProposedOther),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllTotalProposed),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllActual),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllActualOther),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superAllTotalActual),1,'','R');
			    $pdf->Cell(30,$cellH,formatNumber($superVariance),1,'','R');
			    $pdf->Cell(25,$cellH,round($perAll,2).'%',1,'','R');


			$pdf->Output();
	}
}

function others(){
	$others = array();

	if(isset($_GET['dept'])){
		$abbr = $_GET['dept'];
		$getDept = mysql_query("SELECT abbr,department FROM faith_department WHERE abbr = '$abbr' ");
	}else{
		$getDept = mysql_query("SELECT abbr,department FROM faith_department ");
	}

	if(mysql_num_rows($getDept)!=0){
		while($rows=mysql_fetch_assoc($getDept)){
			$dept = $rows['department'];
		}

		$ay = '2016-2017';
		$total = 0;
				$getOthersBudget = mysql_query("
					SELECT  othersem.otherSem_id,othersem.title, CONCAT(profile.firstname, ' ',profile.lastname) as name,
					(
						(othersembreakdown.deanHotel * 
					     					(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'dean'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.chairHotel * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'chair'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.facultyHotel * 
					    					(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'faculty'
											AND sem_emp.email = account.email)  
					    )
					+
						(othersembreakdown.deanDiem * 
					     					(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'dean'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.chairDiem * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'chair'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.facultyDiem * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'faculty'
											AND sem_emp.email = account.email)
					    )

					+
						(othersembreakdown.regDean * 
					     					(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'dean'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.regChair * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'chair'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.regFaculty * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id
					                        AND account.usertype = 'faculty'
											AND sem_emp.email = account.email)
					    )
					 
					+
						(othersembreakdown.transpoDean * 
					     					(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'dean'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.transpoChair * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'chair'
											AND sem_emp.email = account.email)
					    ) + (othersembreakdown.transpoFaculty * 
					         				(SELECT COUNT(sem_emp.email) AS ROWS
											FROM sem_emp, account 
											WHERE attended = 'yes' 
											AND sem_id = othersem.otherSem_id 
					                        AND account.usertype = 'faculty'
											AND sem_emp.email = account.email)
					    )

					) AS budget,

					othersem_proposed.actual
					FROM othersem 
					INNER JOIN othersembreakdown
					ON othersem.otherSem_id = othersembreakdown.otherSem_id
		            INNER JOIN othersem_proposed
		            ON othersem.otherSem_id = othersem_proposed.othersem_id
		            INNER JOIN sem_emp
		            ON othersem.otherSem_id = sem_emp.sem_id
		            INNER JOIN profile
		            ON sem_emp.email = profile.email
					WHERE othersem.department = '$dept' AND othersem.academicyear = '$ay'
					");
				if(mysql_num_rows($getOthersBudget)!=0){
					while($rows=mysql_fetch_assoc($getOthersBudget)){
						$othersem_id = $rows['otherSem_id'];
						$title = $rows['title'];
						$otherbudget = $rows['budget'];
						$otheractual = $rows['actual'];
						
						$others[] = array(
							"seminar" => $rows['title'],
							"name" => $rows['name'],
							"budget" => $budget,
							);
						$total += $otherbudget;
					}
				}
			

		// header('content-type: application/json');
		// echo json_encode($others);

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto');
		$pdf->SetFont('Arial','',20);
		$pdf->AddPage();
		$pdf->Cell(270,10,$dept,0,'','C');
		$pdf->SetFont('Arial','',13);
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',16);
		$pdf->Cell(270,10,'Other Seminars/Trainings',0,'','C');
		$pdf->Ln();

	    $pdf->Ln();
	    $pdf->SetFont('Arial','',15);
	    $pdf->SetLeftMargin(25);
	    $pdf->Cell(80,14,'Seminar/Training',1,'','C');
	    $pdf->Cell(80,14,'Attended By',1,'','C');
	    $pdf->Cell(80,14,'Budget',1,'','C');
	    $pdf->Ln();

	    foreach($others as $other){
	    	$pdf->Cell(80,10,$other['seminar'],1);
	    	$pdf->Cell(80,10,$other['name'],1);
	    	$pdf->Cell(80,10,formatNumber($other['budget']),1,'','R');
	    	$pdf->Ln();
	    }

	    $pdf->SetFont('Arial','B',15);
	    $pdf->Cell(80,14,'Total',1,'','R');
	    $pdf->Cell(80,14,'',1);
	    $pdf->Cell(80,14,formatNumber($total),1,'','R');

	    $pdf->Output();
	}
}

function tnaSum(){
	$sc = array();
	$ay = "2016-2017";

	if(isset($_GET['job'])){
		$getJob = $_GET['job'];

		$totalSchool = 0;
		$allSc = mysql_query("SELECT id,school FROM faith_school");
		while($rows=mysql_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$college = array();
			$allC = mysql_query("SELECT abbr,department FROM faith_department WHERE school_id = '$id' ");
			while($rows=mysql_fetch_assoc($allC)){
				$dept = $rows['department'];
				$abbr = $rows['abbr'];

				$jrQ = mysql_query("
						SELECT COUNT(profile.college) AS countFac
						FROM tna 
						INNER JOIN profile 
						ON tna.email = profile.email 
						WHERE tna.job_role = '$getJob' 
						AND profile.college = '$abbr'
					");
				while($rows=mysql_fetch_assoc($jrQ)){
					$countFac = $rows['countFac'];
				}

				$totalSchool += $countFac;

				$college[] = array(
					"college" => $abbr,
					"freq" => $countFac
					);
			}

			$sc[] = array(
				"school" => $school,
				"college" => $college,
				);

		}

			// header('content-type: application/json');
			// echo json_encode($sc);

			$pdf=new MC_TABLE();
			$pdf->SetAutoPageBreak('auto',20);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage('L');
			// $pdf->Cell(270,5,'Job Roles Competencies',0,'','C');
			// $pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(270,5,'Training Needs Monitoring Summary',0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,5,$getJob,0,'','C');

			$pdf->Ln();
			$pdf->SetLeftMargin(55);
			$pdf->Cell(90,10,'College',1,'','C');
			$pdf->Cell(90,10,'# of Faculty/Staff',1,'','C');
			$pdf->Ln();

		   	foreach($sc as $s){
		   		$short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
		   		$pdf->SetFillColor(200,200,200);
		   		$pdf->Cell(180,10,$short,1,'','C',true);
		   		$pdf->Ln();

		   		foreach($s['college'] as $c){
	   			    $pdf->SetWidths(array(90,90));
	   				$pdf->Row(
	   					array(
	   						$c['college'],$c['freq']
	   						)
	   				,8);
		   		}
	    	}

	    	$pdf->Cell(90,10,'Total',1,'','C');
	    	$pdf->Cell(90,10,$totalSchool,1,'','C');

			$pdf->Output();
	}else{

		$jrQ = mysql_query("SELECT DISTINCT job_role FROM tna");
		while($rows=mysql_fetch_assoc($jrQ)){
			$job_role = $rows['job_role'];

			$countQ = mysql_query("SELECT job_role,email FROM tna WHERE job_role = '$job_role' ");
			$countFac = mysql_num_rows($countQ);

			$tna[] = array(
				"job_role" => $job_role,
				"freq" => $countFac
				);
		}

		// header('content-type: application/json');
		// echo json_encode($tna);

		$pdf=new MC_TABLE();
		$pdf->SetAutoPageBreak('auto',20);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage('L');
		$pdf->Cell(270,5,'Job Roles Competencies',0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,5,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,5,'Training Needs Monitoring Summary',0,'','C');

		$pdf->Ln();
		$pdf->SetLeftMargin(15);
		$pdf->Cell(90,10,'Training Needs',1,'','C');
		$pdf->Cell(90,10,'# of Faculty/Staff',1,'','C');
		$pdf->Cell(90,10,'Remarks',1,'','C');
		$pdf->Ln();

		foreach($tna as $jr){
		    $pdf->SetWidths(array(90,90,90));
			$pdf->Row(
				array(
					$jr['job_role'],$jr['freq'],'link_'.$jr['job_role']
					)
			,8);
    	}

		$pdf->Output();

	}
}

function tna(){
	$tna = array();
	$ay = "2016-2017";
	if(isset($_GET['email'])){

		$email = $_GET['email'];
		$getName = mysql_query("
			SELECT CONCAT(firstname, ' ', lastname) AS name, faith_department.department, account.usertype
			FROM profile 
			INNER JOIN faith_department 
			ON profile.college = faith_department.abbr
			INNER JOIN account
			ON profile.email = account.email
			WHERE profile.email = '$email'
			");
		if(mysql_num_rows($getName)!=0){
			while($rows=mysql_fetch_assoc($getName)){
				$name = $rows['name'];
				$pos = $rows['usertype'];
				$dept = $rows['department'];
			}
		}

		$getTna = mysql_query("
			SELECT job_role, developmentplan, evidence
			FROM tna
			WHERE email = '$email'
			");
		$jrc = array();
		$statCount = 0;
		$rowCount = mysql_num_rows($getTna);
		if($rowCount!=0){
			while($rows=mysql_fetch_assoc($getTna)){
				if($rows['evidence']!=""){
					$status = "Accomplished";
					$statCount += 1;
				}else{
					$status = "Not Accomplished";
				}
				$jrc[] = array(
					"jobrole" => $rows['job_role'],
					"devplan" => $rows['developmentplan'],
					"status" => $status,
					);
			}
		}

		$tna = array(
			"name" => $name,
			"jrc" => $jrc
			);

		// header('content-type: application/json'); 
		// echo json_encode($tna);

		$pdf=new MC_TABLE();
		$pdf->SetAutoPageBreak('auto',20);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage('L');
		$pdf->Cell(270,10,$dept,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'Training Needs Monitoring',0,'','C');

	    $pdf->Ln();
	    $pdf->SetLeftMargin(15);
	    $pdf->Cell(110,14,'Name: '.$name,0);
	    $pdf->Cell(110,14,'Position: '.ucwords($pos),0);
	    $pdf->Cell(110,14,'Date: '.date('M d, Y'),0);
	    $pdf->Ln();
	    $pdf->Cell(90,14,'Job Roles',1,'','C');
	    $pdf->Cell(90,14,'Development Plans',1,'','C');
	    $pdf->Cell(90,14,'Status',1,'','C');
	    $pdf->Ln();

	   	foreach($tna['jrc'] as $jr){
		    $pdf->SetWidths(array(90,90,90));
			$pdf->Row(
				array(
					$jr['jobrole'],$jr['devplan'],$jr['status']
					)
			,8);
    	}

	    $pdf->Output();

	}else if(isset($_GET['dept'])){

		$getDept = $_GET['dept'];

		$superTotalTna = 0;
		$superTotalAcc = 0;
		$totalTna = 0;
		$totalAcc = 0;
		$allSc = mysql_query("SELECT id,school FROM faith_school");
		while($rows=mysql_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$college = array();
			$allA = 0;
			$allP = 0;
			$totalTna = 0;
			$totalAcc = 0;

			$tna = array();
			$allC = mysql_query("SELECT abbr,department FROM faith_department WHERE school_id = '$id' AND abbr = '$getDept' ");
			while($rows=mysql_fetch_assoc($allC)){
				$dept = $rows['department'];
				$abbr = $rows['abbr'];

				$getAllTna = mysql_query("
					SELECT evidence
					FROM tna 
					WHERE department = '$abbr'
					");	

				$getAccStat = mysql_query("
					SELECT evidence
					FROM tna 
					WHERE evidence != '' 
					AND department = '$abbr'
					");

				$allTna = mysql_num_rows($getAllTna);
				$allAccomplish = mysql_num_rows($getAccStat);

				$tna[] = array(
					"college" => $abbr,
					"jobroles" => $allTna,
					"accomplish" => $allAccomplish,
					);


				$totalTna += $allTna;
				$totalAcc += $allAccomplish;

			}

			$sc[] = array(
				"school" => $school,
				"tna" => $tna,
				"allTna" => $totalTna,
				"allAcc" => $totalAcc,
				);

			$superTotalTna += $totalTna;
			$superTotalAcc += $totalAcc;
		}

			// header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = 65;
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',20);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,$cellH-5,$dept,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,$cellH-5,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,$cellH-5,'Comparative Report of Training Needs Analysis',0,'','C');

		    $pdf->Ln();
		    $pdf->SetLeftMargin(15);
		    $pdf->Cell($cellW+65,$cellH,'Proposed TNA',1,'','C');
		    $pdf->Cell($cellW+65,$cellH,'Accomplishments',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell($cellW,$cellH,'% of FSDP',1,'','C');
		    $pdf->Ln();
			$superAllA = 0;
			$superAllP = 0;
		    foreach($sc as $s)
		    {
		    	$tnaAll = $s['allTna'];
		    	$tnaCollegePer = 0;

		    	foreach($s['tna'] as $tna){

			    	if($superTotalTna!=0){
			    		$perTna = ($tna['jobroles']/$superTotalTna)*100;
					}else{
						$perTna = 0;
					}

		    		if($tna['accomplish']!=0){
			    		$perJrc = ($tna['accomplish']/$tna['jobroles'])*100;
					}else{
						$perJrc = 0;
					}

					if($tna['jobroles']!=0){
						$perCollege = 100;
					}else{
						$perCollege = 0;
					}

				    $pdf->Cell($cellW,$cellH,$tna['jobroles'],1,'','R');
				    $pdf->Cell($cellW,$cellH,$perCollege.'%',1,'','R');
				    $pdf->Cell($cellW,$cellH,$tna['accomplish'],1,'','R');
				    $pdf->Cell($cellW,$cellH,round($perJrc,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    }

			$pdf->Output();

	}else{ //overall tna

		$superTotalTna = 0;
		$superTotalAcc = 0;
		$totalTna = 0;
		$totalAcc = 0;
		$allSc = mysql_query("SELECT id,school FROM faith_school");
		while($rows=mysql_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$college = array();
			$allA = 0;
			$allP = 0;
			$totalTna = 0;
			$totalAcc = 0;

			$tna = array();
			$allC = mysql_query("SELECT abbr,department FROM faith_department WHERE school_id = '$id' ");
			while($rows=mysql_fetch_assoc($allC)){
				$dept = $rows['department'];
				$abbr = $rows['abbr'];

				$getAllTna = mysql_query("
					SELECT evidence
					FROM tna 
					WHERE department = '$abbr'
					");	

				$getAccStat = mysql_query("
					SELECT evidence
					FROM tna 
					WHERE evidence != '' 
					AND department = '$abbr'
					");

				$allTna = mysql_num_rows($getAllTna);
				$allAccomplish = mysql_num_rows($getAccStat);

				$tna[] = array(
					"college" => $abbr,
					"jobroles" => $allTna,
					"accomplish" => $allAccomplish,
					);


				$totalTna += $allTna;
				$totalAcc += $allAccomplish;

			}

			$sc[] = array(
				"school" => $school,
				"tna" => $tna,
				"allTna" => $totalTna,
				"allAcc" => $totalAcc,
				);

			$superTotalTna += $totalTna;
			$superTotalAcc += $totalAcc;
		}

			// header('content-type: application/json');
			// echo json_encode($sc);

			$cellW = 45;
			$cellH = 10;

			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto',20);
			$pdf->SetFont('Arial','',11);
			$pdf->AddPage();
			$pdf->Cell(270,$cellH-5,'Tertiary Schools',0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,$cellH-5,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Cell(270,$cellH-5,'Comparative Report of Training Needs Analysis',0,'','C');

		    $pdf->Ln();
		    $pdf->Cell(90,$cellH,'','TL');
		    $pdf->Cell(90,$cellH,'Proposed TNA',1,'','C');
		    $pdf->Cell(90,$cellH,'Accomplishments',1,'','C');
		    $pdf->Ln();
		    $pdf->Cell(90,$cellH,'College','LRB','','C');
		    $pdf->Cell(45,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell(45,$cellH,'% of FSDP',1,'','C');
		    $pdf->Cell(45,$cellH,'# of FSDP',1,'','C');
		    $pdf->Cell(45,$cellH,'% of FSDP',1,'','C');
		    $pdf->Ln();
			$superAllA = 0;
			$superAllP = 0;
		    foreach($sc as $s)
		    {
		    	$tnaAll = $s['allTna'];
		    	$tnaCollegePer = 0;
		    	$short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
		    	$pdf->SetFillColor(200,200,200);
		    	$pdf->Cell(270,$cellH,$short,1,'','C',true);
		    	$pdf->Ln();
		    	
		    	foreach($s['tna'] as $tna){


			    	if($superTotalTna!=0){
			    		$perTna = ($tna['jobroles']/$superTotalTna)*100;
					}else{
						$perTna = 0;
					}

		    		if($tna['accomplish']!=0){
			    		$perJrc = ($tna['accomplish']/$tna['jobroles'])*100;
					}else{
						$perJrc = 0;
					}

					if($tna['jobroles']!=0){
						$perCollege = 100;
					}else{
						$perCollege = 0;
					}

				    $pdf->Cell(90,$cellH,$tna['college'],1,'','L');
				    $pdf->Cell(45,$cellH,$tna['jobroles'],1,'','R');
				    $pdf->Cell(45,$cellH,$perCollege.'%',1,'','R');
				    $pdf->Cell(45,$cellH,$tna['accomplish'],1,'','R');
				    $pdf->Cell(45,$cellH,round($perJrc,2).'%',1,'','R');
			        $pdf->Ln();
		    	}

		    }


		    	$superAll = ($superTotalAcc/$superTotalTna)*100;

			    $pdf->Cell(90,$cellH,'Total',1,'','L');
			    $pdf->Cell(45,$cellH,$superTotalTna,1,'','R');
			    $pdf->Cell(45,$cellH,'100%',1,'','R');
			    $pdf->Cell(45,$cellH,$superTotalAcc,1,'','R');
			    $pdf->Cell(45,$cellH,round($superAll,2).'%',1,'','R');


			$pdf->Output();
	}
}

function tnaFac(){
	$tna = array();
	$ay = "2016-2017";
	if(isset($_GET['email'])){

		$email = $_GET['email'];
		$getName = mysql_query("
			SELECT CONCAT(firstname, ' ', lastname) AS name, faith_department.department, profile.designation
			FROM profile 
			INNER JOIN faith_department 
			ON profile.college = faith_department.abbr
			WHERE profile.email = '$email'
			");
		if(mysql_num_rows($getName)!=0){
			while($rows=mysql_fetch_assoc($getName)){
				$name = $rows['name'];
				$dept = $rows['department'];
				$pos = $rows['designation'];
			}
		}

		$getTna = mysql_query("
			SELECT job_role, position_importance, ability, competency, developmentplan
			FROM tna
			WHERE email = '$email'
			");
		$jrc = array();
		$statCount = 0;
		$rowCount = mysql_num_rows($getTna);
		if($rowCount!=0){
			while($rows=mysql_fetch_assoc($getTna)){
				$jrc[] = array(
					"jobrole" => $rows['job_role'],
					"position" => $rows['position_importance'],
					"person" => $rows['ability'],
					"competency" => $rows['competency'],
					"devplan" => $rows['developmentplan'],
					);
			}
		}

		$tna = array(
			"name" => $name,
			"pos" => $pos,
			"jrc" => $jrc
			);

		// header('content-type: application/json'); 
		// echo json_encode($tna);

		$pdf = new MC_TABLE();
		$pdf->SetAutoPageBreak('auto',10);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage('L');
		$pdf->Cell(270,10,$dept,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'Training Needs Monitoring',0,'','C');

	    $pdf->Ln();
	    $pdf->SetLeftMargin(15);
	    $pdf->Cell(110,14,'Name: '.$name,0);
	    $pdf->Cell(110,14,'Position: '.ucwords($pos),0);
	    $pdf->Cell(110,14,'Date: '.date('M d, Y'),0);
	    $pdf->Ln();
	    $pdf->Cell(90,14,'Job Roles','LRT','','C');
	    $pdf->Cell(30,14,'Position',1,'','C');
	    $pdf->Cell(30,14,'Person',1,'','C');
	    $pdf->Cell(30,14,'Competency',1,'','C');
	    $pdf->Cell(90,14,'Development','LRT','','C');
	    $pdf->Ln();
	    $pdf->Cell(90,8,'Competencies','LRB','','C');
	    $pdf->Cell(30,8,'(Importance)',1,'','C');
	    $pdf->Cell(30,8,'(Ability)',1,'','C');
	    $pdf->Cell(30,8,'Gap',1,'','C');
	    $pdf->Cell(90,8,'Plan','LRB','','C');
	    $pdf->Ln();

    	foreach($tna['jrc'] as $jr){
	    	$pdf->SetWidths(array(90,30,30,30,90));
        	$pdf->Row(
        		array(
        			$jr['jobrole'],$jr['position'],$jr['person'],
        			$jr['competency'],$jr['devplan']
        			)
        	,8);
    	}


	    $pdf->Output();

	}else if(isset($_GET['dept'])){
		$dept = $_GET['dept'];

		$getDept = mysql_query("SELECT department FROM faith_department WHERE abbr = '$dept' ");
		if(mysql_num_rows($getDept)!=0){
			while($rows = mysql_fetch_assoc($getDept)){
				$department = $rows['department'];
			}
		}

		$totalTna = 0;
		$totalAcc = 0;
		$allC = mysql_query("
			SELECT DISTINCT tna.email, CONCAT(profile.firstname,' ',profile.lastname) AS name
			FROM tna 
			INNER JOIN profile 
			ON tna.email = profile.email 
			WHERE tna.department = '$dept'
			");
		while($rows=mysql_fetch_assoc($allC)){
			$email = $rows['email'];
			$name = $rows['name'];

			$getAllTna = mysql_query("
				SELECT evidence
				FROM tna 
				WHERE email = '$email'
				");	

			$getAccStat = mysql_query("
				SELECT evidence
				FROM tna 
				WHERE evidence != '' 
				AND email = '$email'
				");

			$allTna = mysql_num_rows($getAllTna);
			$allAccomplish = mysql_num_rows($getAccStat);

			$tna[] = array(
				"name" => $name,
				"jobroles" => $allTna,
				"accomplish" => $allAccomplish,
				);


			$totalTna += $allTna;
			$totalAcc += $allAccomplish;

		}

		$sc = array(
			"college" => $department,
			"allTna" => $totalTna,
			"allAcc" => $totalAcc,
			"tna" => $tna,
			);

	

		// header('content-type: application/json');
		// echo json_encode($sc);

		$cellW = 45;
		$cellH = 10;

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto',10);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->Cell(270,$cellH,$department,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,$cellH,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,$cellH,'Per Faculty Training Needs Monitoring',0,'','C');

	    $pdf->Ln();
	    $pdf->Cell(90,$cellH,'','TL');
	    $pdf->Cell(90,$cellH,'Proposed Trainings',1,'','C');
	    $pdf->Cell(90,$cellH,'Accomplishments',1,'','C');
	    $pdf->Ln();
	    $pdf->Cell(90,$cellH,'Faculty/Staff','LRB','','C');
	    $pdf->Cell(45,$cellH,'# of FSDP',1,'','C');
	    $pdf->Cell(45,$cellH,'% of FSDP',1,'','C');
	    $pdf->Cell(45,$cellH,'# of FSDP',1,'','C');
	    $pdf->Cell(45,$cellH,'% of FSDP',1,'','C');
	    $pdf->Ln();
    	
    	foreach($sc['tna'] as $tna){

	    	if($totalTna!=0){
	    		$perTna = ($tna['jobroles']/$totalTna)*100;
			}else{
				$perTna = 0;
			}

    		if($tna['accomplish']!=0){
	    		$perJrc = ($tna['accomplish']/$tna['jobroles'])*100;
			}else{
				$perJrc = 0;
			}

		    $pdf->Cell(90,$cellH,$tna['name'],1,'','L');
		    $pdf->Cell(45,$cellH,$tna['jobroles'],1,'','R');
		    $pdf->Cell(45,$cellH,round($perTna,2).'%',1,'','R');
		    $pdf->Cell(45,$cellH,$tna['accomplish'],1,'','R');
		    $pdf->Cell(45,$cellH,round($perJrc,2).'%',1,'','R');
	        $pdf->Ln();
    	}

    	if($sc['allTna']!=0){
    		$superAll = ($sc['allAcc']/$sc['allTna'])*100;
    	}else{
    		$superAll = 0;
    	}

	    $pdf->Cell(90,$cellH,'Total',1,'','R');
	    $pdf->Cell(45,$cellH,$sc['allTna'],1,'','R');
	    $pdf->Cell(45,$cellH,'100%',1,'','R');
	    $pdf->Cell(45,$cellH,$sc['allAcc'],1,'','R');
	    $pdf->Cell(45,$cellH,round($superAll,2).'%',1,'','R');


		$pdf->Output();
	}
}

function mas(){
	$conn = mysqli_connect('localhost', 'root', '', 'efsdpv2');
	$mas = array();
	$ay = "2016-2017";
	$collegeBudget = 0;

	if(isset($_GET['dept'])){

		$dept = $_GET['dept'];

		$getDept = mysqli_query($conn, "SELECT department FROM faith_department WHERE abbr = '$dept' ");
		if(mysqli_num_rows($getDept)!=0){
			while($rows = mysqli_fetch_assoc($getDept)){
				$department = $rows['department'];
			}
		}

		$q = mysqli_query($conn, "SELECT * FROM mustattend INNER JOIN mas_breakdown ON mustattend.mas_id = mas_breakdown.mas_list_id WHERE mustattend.academicyear LIKE '%".$ay."%' AND mustattend.department = ".$dept);

		if(mysqli_num_rows($q)!=0){
			while($rows = mysqli_fetch_assoc($q)){

				$p_involved = array();
				$deans = $rows['numofdean'];
				$chairs = $rows['numofchair'];
				$facs = $rows['numoffaculty'];

				$persons = $deans + $chairs + $facs;

				$deanHotel = $rows['deanHotel'];
				$deanDiem = $rows['deanDiem'];
				$chHotel = $rows['chairHotel'];
				$chDiem = $rows['chairDiem'];
				$facHotel = $rows['facultyHotel'];
				$facDiem = $rows['facultyDiem'];

				$deanReg = $rows['regDean'];
				$deanTranspo = $rows['transpoDean'];
				$chReg = $rows['regChair'];
				$chTranspo = $rows['transpoChair'];
				$facReg = $rows['regFaculty'];
				$facTranspo = $rows['transpoFaculty'];

				$totalHotel = ($deanHotel * $deans)+($chHotel * $chairs)+($facHotel * $facs);
				$totalDiem = ($deanDiem * $deans)+($chDiem * $chairs)+($facDiem * $facs);
				$totalReg = ($deanReg * $deans)+($chReg * $chairs)+($facReg * $facs);
				//$totalFood = $foodFee * $persons;
				$totalTrans = ($deanTranspo * $deans)+($chTranspo * $chairs)+($facTranspo * $facs);;

				$totalBudget = $totalHotel + $totalDiem + $totalReg + $totalTrans;

				if($deans!=0){
					$p_involved[] = "Dean";
				}

				if($chairs!=0){
					$p_involved[] = "Chair";
				}
				if($facs!=0){
					$p_involved[] = "Faculty";
				}

				$p_involved = implode('/', $p_involved);

				$mas[] = array(
					"title" => $rows['title'],
					"category" => $rows['category'],
					"sponsor" => $rows['sponsor'],
					"venue" => $rows['venue'],
					"date" => $rows['dates'],
					"days" => $rows['numdays'],
					"persons" => $persons,
					"persons_involved" => $p_involved,
					"hotel" => $totalHotel,
					"diem" => $totalDiem,
					"reg" => $totalReg,
					// "food" => $totalFood,
					"trans" => $totalTrans,
					"budget" => $totalBudget,
					);

				// $mas[] = $rows;

				$collegeBudget += $totalBudget;
			}
		}

		// header("content-type: application/json");
		// echo json_encode($mas);

		$pdf=new MC_TABLE();
		$pdf->SetAutoPageBreak('auto');
		$pdf->SetFont('Arial','',17);
		$pdf->AddPage('L');
		$pdf->Cell(270,10,$department,0,'','C');
		$pdf->SetFont('Arial','',13);
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',16);
		$pdf->Cell(270,7,'Must-Attend Seminars',0,'','C');
		$pdf->Ln();

		$pdf->SetLeftMargin(15);
	    $pdf->Ln();
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetWidths(array(30,25,20,20,20,32,20,22,20,15,20,20));
		$pdf->Row(
			array(
				'Title','Sponsor Organization','Venue','Estimated Date',
				'Number of Persons','Persons Involved','Number of Days','Registration Fee',
				'Transpo','Hotel','Per Diem','Total Cost'
				),5
		);
    	
    	foreach($mas as $m){
    		$pdf->SetWidths(array(30,25,20,20,20,32,20,22,20,15,20,20));
    		$pdf->Row(
    			array(
    				$m['title'],$m['sponsor'],$m['venue'],date('M d,Y',strtotime($m['date'])),
    				$m['persons'],$m['persons_involved'],$m['days'],$m['reg'],
    				$m['trans'],$m['hotel'],$m['diem'],formatNumber($m['budget'])
    				),5
    		);
    	}

    	$pdf->SetFont('Arial','B',10);
	    $pdf->Cell(224,12,'',0,'','R');
	    $pdf->Cell(20,12,'Total','LB','','R');
	    $pdf->Cell(20,12,formatNumber($collegeBudget),'RB','','L');


		$pdf->Output();

	}
}

function fsdp($masComp){
	$conn = mysqli_connect('localhost', 'root', '', 'efsdpv2');
	$fs = 18;
	$cw = 60;

	$sc = array();
	$ay = '2016-2017';

	$masTs = 0;
	$tnaTs = 0;
	$othersTs = 0;

	if(isset($_GET['dept'])){
		$getDept = $_GET['dept'];
		$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
		while($rows=mysqli_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$masSchool = 0;
			$tnaSchool = 0;
			$othersSchool = 0;
			$totalSchool = 0;

			$college = array();
			$allC = mysqli_query($conn, "SELECT * FROM faith_department WHERE school_id = '$id' AND abbr = '$getDept' ");
			while($rows=mysqli_fetch_assoc($allC)){
				$dept_id = $rows['id'];
				$dept = $rows['department'];
				$abbr = $rows['abbr'];

				$ma = array();

				$masCollege = 0;
				$othersCollege = 0;
				$totalCollege = 0;

				$getMasBudget = mysqli_query($conn, "
					SELECT  mustattend.mas_id,mustattend.title, 
					
					$masComp

					mas_proposed.actual
					FROM mustattend 
					INNER JOIN masbreakdown
					ON mustattend.mas_id = masbreakdown.mas_list_id
		            INNER JOIN mas_proposed
		            ON mustattend.mas_id = mas_proposed.mas_list_id
					WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
				");

				$totalProposedCollege = 0;
				if(mysqli_num_rows($getMasBudget)!=0){
					while($rows=mysqli_fetch_assoc($getMasBudget))
					{
						$masid = $rows['masid'];
						$title = $rows['title'];
						$masbudget = $rows['budget'];

						$getAttendees = mysqli_query($conn, "
							SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
							FROM sem_emp, account 
							WHERE attended = 'yes' 
							AND sem_id = '$masid' 
							AND sem_emp.email = account.email
						");

						$masCollege += $masbudget;
					}
				}

					//TNA BUDGET
					$tnaCollege = 0;
					$getTnaBudget = mysqli_query($conn, "
						SELECT sem_emp.sem_id, sem_emp.email,account.usertype
						FROM sem_emp
						INNER JOIN masbreakdown
						ON sem_emp.sem_id = masbreakdown.masid
						INNER JOIN account
						ON sem_emp.email = account.email
						INNER JOIN mustattend
						ON sem_emp.sem_id = mustattend.masid
						WHERE sem_emp.type = 'TNA' AND mustattend.department = '$abbr'
					 ");
					if(mysqli_num_rows($getTnaBudget)!=0){
						while($rows=mysqli_fetch_assoc($getTnaBudget))
						{
							$position = $rows['usertype'];
							if($position=="dean"){
								$getMyBudget = mysqli_query($conn, "SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else if($position=="chair"){
								$getMyBudget = mysqli_query($conn, "SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else if($position=="faculty"){
								$getMyBudget = mysqli_query($conn, "SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else{
								echo "HOW?";
							}
							while($rows=mysqli_fetch_assoc($getMyBudget))
							{
								$my_budget = $rows['my_budget'];
							}
							$tnaCollege += $my_budget;
						}
					}
					//TNA BUDGET-->

					//OTHERS BUDGET
					$getOthersBudget = mysqli_query($conn, "
						SELECT  othersem.otherSem_id,othersem.title, 
						(
							(othersembreakdown.deanHotel * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairHotel * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyHotel * 
						    					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)  
						    )
						+
							(othersembreakdown.deanDiem * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						+
							(othersembreakdown.regDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )
						 
						+
							(othersembreakdown.transpoDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						) AS budget,

						othersem_proposed.actual
						FROM othersem 
						INNER JOIN othersembreakdown
						ON othersem.otherSem_id = othersembreakdown.otherSem_id
			            INNER JOIN othersem_proposed
			            ON othersem.otherSem_id = othersem_proposed.othersem_id
						WHERE othersem.department = '$abbr' AND othersem.academicyear = '$ay'
						");
					if(mysqli_num_rows($getOthersBudget)!=0){
						while($rows=mysqli_fetch_assoc($getOthersBudget)){
							$othersem_id = $rows['otherSem_id'];
							$title = $rows['title'];
							$otherbudget = $rows['budget'];
							$otheractual = $rows['actual'];
							$othersCollege += $otherbudget;
						}
					}
					//OTHERS BUDGET-->

					// $totalProposedCollege += $masCollege;
					$totalCollege = $masCollege + $tnaCollege + $othersCollege;

					$college[] = array(
						"college" => $abbr,
						"masCollege" => $masCollege,
						"tnaCollege" => $tnaCollege,
						"othersCollege" => $othersCollege,
						"totalCollege" => $totalCollege
					);
				
					// $totalCollege = 0;
					$masSchool += $masCollege;
					$tnaSchool += $tnaCollege;
					$othersSchool += $othersCollege;
			}

				$totalSchool = $masSchool + $tnaSchool + $othersSchool;

				$sc[] = array(
					"school" => $school,
					"masSchool" => $masSchool,
					"tnaSchool" => $tnaSchool,
					"otherSchool" => $othersSchool,
					"totalSchool" => $totalSchool,
					"college" => $college
					);

				$masTs += $masSchool;
				$tnaTs += $tnaSchool;
				$othersTs += $othersSchool;
		}


		$totalTs = $masTs + $tnaTs + $othersTs;



		header('content-type: application/json');
		// echo json_encode($sc);

		$cellW = 60;

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto');
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->Cell(270,10,$dept,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'FSDP Summary of Proposed Budget',0,'','C');
		$pdf->Ln();

		$pdf->SetLeftMargin(30);
	    $pdf->Cell(240,10,'Proposed BUDGET',1,'','C');
	    $pdf->Ln();
	    $pdf->Cell($cellW,10,'MAS',1,'','C');
	    $pdf->Cell($cellW,10,'TNA',1,'','C');
	    $pdf->Cell($cellW,10,'Others',1,'','C');
	    $pdf->Cell($cellW,10,'TOTAL',1,'','C');
	    $pdf->Ln();

	    foreach($sc as $s){
	    	foreach($s['college'] as $c){
	    		$pdf->Cell($cellW,10,formatNumber($c['masCollege']),1,'','R');
	    		$pdf->Cell($cellW,10,formatNumber($c['tnaCollege']),1,'','R');
	    		$pdf->Cell($cellW,10,formatNumber($c['othersCollege']),1,'','R');
	    		$pdf->Cell($cellW,10,formatNumber($c['totalCollege']),1,'','R');
	    		$pdf->Ln();
	    	}
	    }



		$pdf->Output();
	}else{

		$allSc = mysqli_query($conn, "SELECT id,school FROM faith_school");
		while($rows=mysqli_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$masSchool = 0;
			$tnaSchool = 0;
			$othersSchool = 0;
			$totalSchool = 0;

			$college = array();
			$allC = mysqli_query($conn, "SELECT * FROM faith_department WHERE school_id = '$id' ");
			while($rows=mysqli_fetch_assoc($allC)){
				$dept_id = $rows['id'];
				$dept = $rows['department'];
				$abbr = $rows['abbr'];

				$ma = array();

				$masCollege = 0;
				$othersCollege = 0;
				$totalCollege = 0;

				$getMasBudget = mysqli_query($conn, "
						SELECT  mustattend.masid,mustattend.title, 
						
						$masComp

						mas_proposed.actual
						FROM mustattend 
						INNER JOIN masbreakdown
						ON mustattend.masid = masbreakdown.masid
			            INNER JOIN mas_proposed
			            ON mustattend.masid = mas_proposed.mas_id
						WHERE mustattend.department = '$abbr' AND mustattend.academicyear = '$ay'
						");

				$totalProposedCollege = 0;
				if(mysqli_num_rows($getMasBudget)!=0){
					while($rows=mysqli_fetch_assoc($getMasBudget))
					{
						$masid = $rows['masid'];
						$title = $rows['title'];
						$masbudget = $rows['budget'];

						$getAttendees = mysqli_query("
							SELECT sem_emp.email,account.usertype AS position,sem_emp.attended 
							FROM sem_emp, account 
							WHERE attended = 'yes' 
							AND sem_id = '$masid' 
							AND sem_emp.email = account.email
						");

						$masCollege += $masbudget;
					}
				}

					//TNA BUDGET
					$tnaCollege = 0;
					$getTnaBudget = mysqli_query($conn, "
						SELECT sem_emp.sem_id, sem_emp.email,account.usertype
						FROM sem_emp
						INNER JOIN masbreakdown
						ON sem_emp.sem_id = masbreakdown.masid
						INNER JOIN account
						ON sem_emp.email = account.email
						INNER JOIN mustattend
						ON sem_emp.sem_id = mustattend.masid
						WHERE sem_emp.type = 'TNA' AND mustattend.department = '$abbr'
					 ");
					if(mysql_num_rows($getTnaBudget)!=0){
						while($rows=mysql_fetch_assoc($getTnaBudget))
						{
							$position = $rows['usertype'];
							if($position=="dean"){
								$getMyBudget = mysql_query("SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else if($position=="chair"){
								$getMyBudget = mysql_query("SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else if($position=="faculty"){
								$getMyBudget = mysql_query("SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM masbreakdown WHERE masid = '$masid'");
							}else{
								echo "HOW?";
							}
							while($rows=mysql_fetch_assoc($getMyBudget))
							{
								$my_budget = $rows['my_budget'];
							}
							$tnaCollege += $my_budget;
						}
					}
					//TNA BUDGET-->

					//OTHERS BUDGET
					$getOthersBudget = mysql_query("
						SELECT  othersem.otherSem_id,othersem.title, 
						(
							(othersembreakdown.deanHotel * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairHotel * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyHotel * 
						    					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)  
						    )
						+
							(othersembreakdown.deanDiem * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.chairDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.facultyDiem * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						+
							(othersembreakdown.regDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.regFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )
						 
						+
							(othersembreakdown.transpoDean * 
						     					(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'dean'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoChair * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'chair'
												AND sem_emp.email = account.email)
						    ) + (othersembreakdown.transpoFaculty * 
						         				(SELECT COUNT(sem_emp.email) AS ROWS
												FROM sem_emp, account 
												WHERE attended = 'yes' 
												AND sem_id = othersem.otherSem_id 
						                        AND account.usertype = 'faculty'
												AND sem_emp.email = account.email)
						    )

						) AS budget,

						othersem_proposed.actual
						FROM othersem 
						INNER JOIN othersembreakdown
						ON othersem.otherSem_id = othersembreakdown.otherSem_id
			            INNER JOIN othersem_proposed
			            ON othersem.otherSem_id = othersem_proposed.othersem_id
						WHERE othersem.department = '$abbr' AND othersem.academicyear = '$ay'
						");
					if(mysql_num_rows($getOthersBudget)!=0){
						while($rows=mysql_fetch_assoc($getOthersBudget)){
							$othersem_id = $rows['otherSem_id'];
							$title = $rows['title'];
							$otherbudget = $rows['budget'];
							$otheractual = $rows['actual'];
							$othersCollege += $otherbudget;
						}
					}
					//OTHERS BUDGET-->

					// $totalProposedCollege += $masCollege;
					$totalCollege = $masCollege + $tnaCollege + $othersCollege;

					$college[] = array(
						"college" => $abbr,
						"masCollege" => $masCollege,
						"tnaCollege" => $tnaCollege,
						"othersCollege" => $othersCollege,
						"totalCollege" => $totalCollege
					);
				
					// $totalCollege = 0;
					$masSchool += $masCollege;
					$tnaSchool += $tnaCollege;
					$othersSchool += $othersCollege;
			}

				$totalSchool = $masSchool + $tnaSchool + $othersSchool;

				$sc[] = array(
					"school" => $school,
					"masSchool" => $masSchool,
					"tnaSchool" => $tnaSchool,
					"otherSchool" => $othersSchool,
					"totalSchool" => $totalSchool,
					"college" => $college
					);

				$masTs += $masSchool;
				$tnaTs += $tnaSchool;
				$othersTs += $othersSchool;
		}


		$totalTs = $masTs + $tnaTs + $othersTs;



		header('content-type: application/json');
		// echo json_encode($sc);

		$cellW = 45;

		$pdf = new FPDF('L');
		$pdf->SetAutoPageBreak('auto',30);
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->Cell(270,10,'Tertiary Schools',0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		$pdf->Ln();
		$pdf->Cell(270,10,'FSDP Summary of Proposed Budget',0,'','C');

	    $pdf->Ln();
	    $pdf->Cell(90,10,'',1,'','C');
	    $pdf->Cell(185,10,'Proposed BUDGET',1,'','C');
	    $pdf->Ln();
	    $pdf->Cell(90,10,'College',1,'','C');
	    $pdf->Cell(45,10,'MAS',1,'','C');
	    $pdf->Cell(45,10,'TNA',1,'','C');
	    $pdf->Cell(45,10,'Others',1,'','C');
	    $pdf->Cell(50,10,'TOTAL',1,'','C');
	    $pdf->Ln();

	    foreach($sc as $s){
	    	$short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
	    	$pdf->SetFillColor(200,200,200);
	    	$pdf->Cell(275,10,$short,1,'','C',true);
	    	$pdf->Ln();
	    	foreach($s['college'] as $c){
	    		$pdf->Cell(90,10,$c['college'],1);
	    		$pdf->Cell(45,10,formatNumber($c['masCollege']),1,'','R');
	    		$pdf->Cell(45,10,formatNumber($c['tnaCollege']),1,'','R');
	    		$pdf->Cell(45,10,formatNumber($c['othersCollege']),1,'','R');
	    		$pdf->Cell(50,10,formatNumber($c['totalCollege']),1,'','R');
	    		$pdf->Ln();
	    	}
	    	$pdf->Cell(90,10,'Subtotal',1,'','R');
	    	$pdf->Cell(45,10,formatNumber($s['masSchool']),1,'','R');
	    	$pdf->Cell(45,10,formatNumber($s['tnaSchool']),1,'','R');
	    	$pdf->Cell(45,10,formatNumber($s['otherSchool']),1,'','R');
	    	$pdf->Cell(50,10,formatNumber($s['totalSchool']),1,'','R');
	    	$pdf->Ln();
	    }
	    $pdf->SetFont('Arial','B',12);
	    $pdf->Cell(90,10,'TOTAL',1,'','R');
	    $pdf->Cell(45,10,formatNumber($masTs),1,'','R');
	    $pdf->Cell(45,10,formatNumber($tnaTs),1,'','R');
	    $pdf->Cell(45,10,formatNumber($othersTs),1,'','R');
	    $pdf->Cell(50,10,formatNumber($totalTs),1,'','R');
	    $pdf->Ln();



		$pdf->Output();
	}
}

function masResearch(){
	$mas = array();
	$ay = "2016-2017";
	$collegeBudget = 0;

	if(isset($_GET['dept'])){
		$dept = $_GET['dept'];

		$getDept = mysql_query("SELECT department FROM faith_department WHERE abbr = '$dept' ");
		if(mysql_num_rows($getDept)!=0){
			while($rows = mysql_fetch_assoc($getDept)){
				$department = $rows['department'];
			}
		}

		if(isset($_GET['category'])){
			$cat = $_GET['category'];
			$q = mysql_query("
				SELECT * FROM mustattend 
				INNER JOIN masbreakdown 
				ON mustattend.masid = masbreakdown.masid 
				WHERE mustattend.academicyear = '$ay' 
				AND mustattend.department = '$dept'
				AND mustattend.category = '$cat'
				");
		}else{
			$q = mysql_query("
				SELECT * FROM mustattend 
				INNER JOIN masbreakdown 
				ON mustattend.masid = masbreakdown.masid 
				WHERE mustattend.academicyear = '$ay' 
				AND mustattend.department = '$dept'
				AND (mustattend.category = 'FACE' OR mustattend.category = 'Research')
				");
		}

			if(mysql_num_rows($q)!=0){
				while($rows = mysql_fetch_assoc($q)){

					$p_involved = array();
					$deans = $rows['numofdean'];
					$chairs = $rows['numofchair'];
					$facs = $rows['numoffaculty'];

					$persons = $deans + $chairs + $facs;

					$deanHotel = $rows['deanHotel'];
					$deanDiem = $rows['deanDiem'];
					$deanReg = $rows['regDean'];
					$deanTrans = $rows['transpoDean'];

					$chHotel = $rows['chairHotel'];
					$chDiem = $rows['chairDiem'];
					$chReg = $rows['regChair'];
					$chTrans = $rows['transpoChair'];

					$facHotel = $rows['facultyHotel'];
					$facDiem = $rows['facultyDiem'];
					$facReg = $rows['regFaculty'];
					$facTrans = $rows['transpoFaculty'];

					$totalHotel = ($deanHotel * $deans)+($chHotel * $chairs)+($facHotel * $facs);
					$totalDiem = ($deanDiem * $deans)+($chDiem * $chairs)+($facDiem * $facs);
					$totalReg = ($deanReg * $deans)+($chReg * $chairs)+($facReg * $facs);
					//$totalFood = $foodFee * $persons;
					$totalTrans = ($deanTrans * $deans)+($chTrans * $chairs)+($facTrans * $facs);

					$totalBudget = $totalHotel + $totalDiem + $totalReg + $totalTrans;

					if($deans!=0){
						$p_involved[] = "Dean";
					}

					if($chairs!=0){
						$p_involved[] = "Chair";
					}
					if($facs!=0){
						$p_involved[] = "Faculty";
					}

					$p_involved = implode('/', $p_involved);

					$mas[] = array(
						"title" => $rows['title'],
						"category" => $rows['category'],
						"sponsor" => $rows['sponsor'],
						"venue" => $rows['venue'],
						"date" => $rows['dates'],
						"days" => $rows['numdays'],
						"persons" => $persons,
						"persons_involved" => $p_involved,
						"hotel" => $totalHotel,
						"diem" => $totalDiem,
						"reg" => $totalReg,
						// "food" => $totalFood,
						"trans" => $totalTrans,
						"budget" => $totalBudget,
						);

					// $mas[] = $rows;

					$collegeBudget += $totalBudget;
				}
			}

			// header("content-type: application/json");
			// echo json_encode($mas);

			$w = 20;
			$h = 8;
			$pdf = new FPDF('L');
			$pdf->SetAutoPageBreak('auto');
			$pdf->SetFont('Arial','',20);
			$pdf->AddPage();
			$pdf->Cell(270,10,$department,0,'','C');
			$pdf->SetFont('Arial','',13);
			$pdf->Ln();
			$pdf->Cell(270,10,'AY '.$ay,0,'','C');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','',16);
			$pdf->Cell(270,10,'Must-Attend Seminars (FACE/Research)',0,'','C');
			$pdf->Ln();

			$pdf->SetLeftMargin(6);
		    $pdf->Ln();
			$pdf->SetFont('Arial','',10);

		    $pdf->Cell(30,$h,'Title','RLT','','C');	
		    $pdf->Cell(30,$h,'Category','RLT','','C');
		    $pdf->Cell(25,$h,'Sponsor','RLT','','C');
		    $pdf->Cell(20,$h,'Venue','RLT','','C');
		    $pdf->Cell(20,$h,'Estimated','RLT','','C');
		    $pdf->Cell(20,$h,'Number','RLT','','C');
		    $pdf->Cell(32,$h,'Persons Involved','RLT','','C');
		    $pdf->Cell(20,$h,'Number','RLT','','C');
		    $pdf->Cell(22,$h,'Registration','RLT','','C');
		    // $pdf->Cell(22,$h,'Food','RLT','','C');
		    $pdf->Cell(20,$h,'Transpo','RLT','','C');
		    $pdf->Cell(15,$h,'Hotel','RLT','','C');
		    $pdf->Cell(20,$h,'Per Diem','RLT','','C');
		    $pdf->Cell(20,$h,'Total Cost','RLT','','C');
		    $pdf->Ln();
		    $pdf->Cell(30,$h-5,'','RLB','','C');
		    $pdf->Cell(30,$h-5,'','RLB','','C');
		    $pdf->Cell(25,$h-5,'Organization','RLB','','C');
		    $pdf->Cell(20,$h-5,'','RLB','','C');
		    $pdf->Cell(20,$h-5,'Date','RLB','','C');
		    $pdf->Cell(20,$h-5,'of Persons','RLB','','C');
		    $pdf->Cell(32,$h-5,'','RLB','','C');
		    $pdf->Cell(20,$h-5,'of Days','RLB','','C');
		    $pdf->Cell(22,$h-5,'Fee','RLB','','C');
		    // $pdf->Cell(22,$h-5,'','RLB','','C');
		    $pdf->Cell(20,$h-5,'AirFare','RLB','','C');
		    $pdf->Cell(15,$h-5,'Accom.','RLB','','C');
		    $pdf->Cell(20,$h-5,'','RLB','','C');
		    $pdf->Cell(20,$h-5,'','RLB','','C');
		    $pdf->Ln();
	    	
	    	foreach($mas as $m){
			    $pdf->Cell(30,10,$m['title'],1);
			    $pdf->Cell(30,10,$m['category'],1);
			    $pdf->Cell(25,10,$m['sponsor'],1);
			    $pdf->Cell(20,10,$m['venue'],1);
			    $pdf->Cell(20,10,date('m/d/y',strtotime($m['date'])),1);
			    $pdf->Cell(20,10,$m['persons'],1,'','C');
			    $pdf->Cell(32,10,$m['persons_involved'],'RLB','','C');
			    $pdf->Cell(20,10,$m['days'],1,'','C');
			    $pdf->Cell(22,10,$m['reg'],1,'','C');
			    // $pdf->Cell(22,10,$m['food'],1,'','C');
			    $pdf->Cell(20,10,$m['trans'],1,'','C');
			    $pdf->Cell(15,10,$m['hotel'],1,'','C');
			    $pdf->Cell(20,10,$m['diem'],1,'','C');
			    $pdf->Cell(20,10,formatNumber($m['budget']),1,'','R');
		        $pdf->Ln();
	    	}

		    $pdf->SetFont('Arial','B',10);
		    $pdf->Cell(246,12,'',0,'','R');
		    $pdf->Cell(20,12,'Total','LB','','R');
		    $pdf->Cell(20,12,formatNumber($collegeBudget),'RB','','L');


			$pdf->Output();
		
	}else{

		$sc = array();
		//count school
		$allSc = mysql_query("SELECT id,school FROM faith_school");
		while($rows=mysql_fetch_assoc($allSc)){
			$school = $rows['school'];
			$id = $rows['id'];

			$college = array();
			//count college
			$allC = mysql_query("SELECT * FROM faith_department WHERE school_id = '$id' ");
			while($rows=mysql_fetch_assoc($allC)){
				$dept_id = $rows['id'];
				$dept = $rows['department'];
				$abbr = $rows['abbr'];
			
			//count seminars
			$mas = array();
			if(isset($_GET['category'])){
				$cat = $_GET['category'];
				$q2 = mysql_query("
					SELECT * FROM mustattend 
					INNER JOIN masbreakdown 
					ON mustattend.masid = masbreakdown.masid 
					WHERE mustattend.academicyear = '$ay' 
					AND mustattend.department = '$abbr'
					AND mustattend.category = '$cat'
					");
			}else{
				$cat = "FACE/Research";
				$q2 = mysql_query("
					SELECT * FROM mustattend 
					INNER JOIN masbreakdown 
					ON mustattend.masid = masbreakdown.masid 
					WHERE mustattend.academicyear = '$ay' 
					AND mustattend.department = '$abbr'
					AND (mustattend.category = 'FACE' OR mustattend.category = 'Research')
					");
			}
			

				if(mysql_num_rows($q2)!=0){
					while($rows = mysql_fetch_assoc($q2)){

						$p_involved = array();
						$deans = $rows['numofdean'];
						$chairs = $rows['numofchair'];
						$facs = $rows['numoffaculty'];

						$persons = $deans + $chairs + $facs;

						$deanHotel = $rows['deanHotel'];
						$deanDiem = $rows['deanDiem'];
						$deanReg = $rows['regDean'];
						$deanTrans = $rows['transpoDean'];

						$chHotel = $rows['chairHotel'];
						$chDiem = $rows['chairDiem'];
						$chReg = $rows['regChair'];
						$chTrans = $rows['transpoChair'];

						$facHotel = $rows['facultyHotel'];
						$facDiem = $rows['facultyDiem'];
						$facReg = $rows['regFaculty'];
						$facTrans = $rows['transpoFaculty'];

						$totalHotel = ($deanHotel * $deans)+($chHotel * $chairs)+($facHotel * $facs);
						$totalDiem = ($deanDiem * $deans)+($chDiem * $chairs)+($facDiem * $facs);
						$totalReg = ($deanReg * $deans)+($chReg * $chairs)+($facReg * $facs);
						//$totalFood = $foodFee * $persons;
						$totalTrans = ($deanTrans * $deans)+($chTrans * $chairs)+($facTrans * $facs);

						$totalBudget = $totalHotel + $totalDiem + $totalReg + $totalTrans;

						if($deans!=0){
							$p_involved[] = "Dean";
						}

						if($chairs!=0){
							$p_involved[] = "Chair";
						}
						if($facs!=0){
							$p_involved[] = "Faculty";
						}

						$p_involved = implode('/', $p_involved);

						$mas[] = array(
							"title" => $rows['title'],
							"category" => $rows['category'],
							"sponsor" => $rows['sponsor'],
							"venue" => $rows['venue'],
							"date" => $rows['dates'],
							"days" => $rows['numdays'],
							"persons" => $persons,
							"persons_involved" => $p_involved,
							"hotel" => $totalHotel,
							"diem" => $totalDiem,
							"reg" => $totalReg,
							// "food" => $totalFood,
							"trans" => $totalTrans,
							"budget" => $totalBudget,
							);

						// $mas[] = $rows;

						$collegeBudget += $totalBudget;
					}

					$college[] = array(
						"department" => $abbr,
						"mas" => $mas
						);
				}
			}

			$sc[] = array(
				"school" => $school,
				"college" => $college,
				);
		}

				// header("content-type: application/json");
				// echo json_encode($sc);

				$w = 20;
				$h = 8;
				$pdf = new FPDF('L');
				$pdf->SetAutoPageBreak('auto');

			    foreach($sc as $s){
			    	// $short = strtoupper(preg_replace('~\b(\w)|.~', '$1', $s['school']));
			    	// $pdf->SetFillColor(200,200,200);
			    	// $pdf->Cell(275,10,$short,1,'','C',true);
			    	// $pdf->Ln();
			    	$pdf->SetFont('Arial','',20);
		    		$pdf->AddPage();
		    		$pdf->Cell(270,10,$s['school'],0,'','C');
		    		$pdf->Ln();
			    	$pdf->SetFont('Arial','',15);
		    		$pdf->Cell(270,10,'Must-Attend Seminars ('.$cat.')',0,'','C');
		    		$pdf->SetFont('Arial','',13);
		    		$pdf->Ln();
		    		$pdf->Cell(270,10,'AY '.$ay,0,'','C');
		    		$pdf->Ln();
		    		$pdf->Ln();

			    	foreach($s['college'] as $c){
			    		
		    			$pdf->SetFont('Arial','',16);
		    			$pdf->Cell(270,10,$c['department'],0,'','C');
		    			$pdf->Ln();

		    			$pdf->SetLeftMargin(6);
		    		    $pdf->Ln();
		    			$pdf->SetFont('Arial','',10);

		    		    $pdf->Cell(80,$h,'Title',1,'','C');
		    		    $pdf->Cell(20,$h,'Date',1,'','C');
		    		    $pdf->Cell(30,$h,'Number of PAX',1,'','C');
		    		    $pdf->Cell(40,$h,'Persons Involved',1,'','C');
		    		    $pdf->Cell(30,$h,'Number of Days',1,'','C');
		    		    $pdf->Cell(40,$h,'Total Cost',1,'','C');
		    		    $pdf->Ln();

	    		        	foreach($c['mas'] as $m){
	    		    		    $pdf->Cell(80,10,$m['title'],1);
	    		    		    $pdf->Cell(20,10,date('m/d/y',strtotime($m['date'])),1);
	    		    		    $pdf->Cell(30,10,$m['persons'],1,'','C');
	    		    		    $pdf->Cell(40,10,$m['persons_involved'],'RLB','','C');
	    		    		    $pdf->Cell(30,10,$m['days'],1,'','C');
	    		    		    $pdf->Cell(40,10,formatNumber($m['budget']),1,'','R');
	    		    	        $pdf->Ln();
	    		        	}
	    		    	        $pdf->Ln();
	    		    	        $pdf->Ln();
			    	}

			    }
		    	
				    // $pdf->SetFont('Arial','B',10);
				    // $pdf->Cell(246,12,'',0,'','R');
				    // $pdf->Cell(20,12,'Total','LB','','R');
				    // $pdf->Cell(20,12,formatNumber($collegeBudget),'RB','','L');
		    	



				$pdf->Output();

	}
}
?>

