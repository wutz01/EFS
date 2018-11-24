<?php
function masV()
{
	$ay = $_POST['ay'];
$datecreated = $_POST['datecreated'];
$school = $_POST['school'];
$department = $_POST['department'];
$title = $_POST['title'];
$category = $_POST['category'];
$sponsor = $_POST['sponsor'];
$date = $_POST['date'];
$days = $_POST['days'];
$venue = $_POST['venue'];

$person = $_POST['numDean'] + $_POST['numChair'] + $_POST['numFaculty'];
$totalHotel = $_POST['hotelDean'] + $_POST['hotelChair'] +  $_POST['hotelFaculty'];
$totalDiem = $_POST['diemDean'] + $_POST['diemChair'] +  $_POST['diemFaculty'];
$totalTranspo = $_POST['transpoDean'] + $_POST['transpoChair'] +  $_POST['transpoFaculty'];
$totalReg = $_POST['regDean'] + $_POST['regChair'] +  $_POST['regFaculty'];
$budget = $totalHotel + $totalDiem + $totalReg + $totalTranspo;


$numDean = $_POST['numDean'];
$numChair = $_POST['numChair'];
$numFaculty = $_POST['numFaculty'];
$hotelDean = $_POST['hotelDean'];
$hotelChair = $_POST['hotelChair'];
$hotelFaculty = $_POST['hotelFaculty'];
$diemDean = $_POST['diemDean'];
$diemChair = $_POST['diemChair'];
$diemFaculty = $_POST['diemFaculty'];
$regDean = $_POST['regDean'];
$regChair = $_POST['regChair'];
$regFaculty = $_POST['regFaculty'];
$transpoDean = $_POST['transpoDean'];
$transpoChair = $_POST['transpoChair'];
$transpoFaculty = $_POST['transpoFaculty'];
}
?>