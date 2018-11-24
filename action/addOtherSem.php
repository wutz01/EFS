<?php


$data = $_GET['data'];

include("../db/config.php");
$ay = "2016-2017";

$otherSem_id = rand(1000000,9999999);

$email = $data['email'];

$dateCreated = $data['dateCreated'];
$title = $data['title'];
$category = $data['category'];
$sponsor = $data['sponsor'];
$date = $data['date'];
$days = $data['days'];
$persons = $data['persons'];
$venue = $data['venue'];
$reasons = $data['reasons'];
$echoSched = $data['echoSched'];
$echoSched = implode(';',$echoSched);

$numDean = $data['numDean'];
$deanHotel = $data['deanHotel'];
$deanDiem = $data['deanDiem'];
$numChair = $data['numChair'];
$chairHotel = $data['chairHotel'];
$chairDiem = $data['chairDiem'];
$numFac = $data['numFac'];
$facHotel = $data['facHotel'];
$facDiem = $data['facDiem'];
$regFee = $data['regFee'];
$foodFee = $data['foodFee'];
$transFee = $data['transFee'];
$otherFee = $data['otherFee'];
$budget = $data['budget'];

$findSchool = mysql_query("SELECT * FROM profile WHERE email = '$email' ");
while($rows=mysql_fetch_assoc($findSchool)){
	$school = $rows['school'];
	$department = $rows['college'];
}

$otherSem = mysql_query("INSERT INTO othersem (otherSem_id,academicyear, datecreated, school, department, title, category, sponsor, dates, numdays, venue, numperson, budget)
								VALUES ('$otherSem_id','$ay','$dateCreated','$school','$department','$title','$category','$sponsor','$date','$days','$venue','$persons','$budget')");

$otherBreakdowon = mysql_query("INSERT INTO othersembreakdown (otherSem_id, numofdean, numofchair, numoffaculty, deanHotel, chairHotel, facultyHotel, deanDiem, chairDiem, facultyDiem, regFee, foodFee, transFee) 
												VALUES ('$otherSem_id','$numDean','$numChair','$numFac','$deanHotel','$chairHotel','$facHotel','$deanDiem','$chairDiem','$facDiem','$regFee','$foodFee','$transFee') ");

$otherSem_emp = mysql_query("INSERT INTO sem_emp (sem_id, email, echoSched, documents, reasons) 
														VALUES ('$otherSem_id','$email','$echoSched','PENDING','$reasons') ");

if($otherFee!=""){
	foreach($otherFee as $fee){
		$otherFeeTitle = $fee['title'];
		$otherFeeValue = $fee['value'];

		$addOtherFee = mysql_query("INSERT INTO otherfee (sem_id, title, value, type) VALUES ('$otherSem_id', '$otherFeeTitle', '$otherFeeValue', 'others') ");
	}
}

// print_r($data);

