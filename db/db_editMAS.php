<?php
$Transtotal = $_POST['transTotal'];
$regtotal = $_POST['Regtotal'];
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require ("config.php");
$conn = mysqli_connect('localhost', 'root', '', 'efs');
        
    $ay = $_POST['ay'];
    $datecreated = $_POST['datecreated'];
    $school = $_POST['school'];
    $department = $_POST['department'];//k
    $title = $_POST['title'];
    $category = $_POST['category'];//k
    $sponsor = $_POST['sponsor'];
    $date = $_POST['date'];
    $days = $_POST['days'];
    $venue = $_POST['venue'];
    $numDean = $_POST['numDean'];
    $numChair = $_POST['numChair'];
    $numFaculty = $_POST['numFaculty'];
    $hotelDean = $_POST['hotelDean'];
    $hotelChair = $_POST['hotelChair'];
    $hotelFaculty = $_POST['hotelFaculty'];
    $diemDean = $_POST['diemDean'];
    $diemChair = $_POST['diemChair'];
    $diemFaculty = $_POST['diemFaculty'];

    //Computation
    $person = $_POST['numDean'] + $_POST['numChair'] + $_POST['numFaculty'];
    $totalHotel = $_POST['hotelDean'] + $_POST['hotelChair'] +  $_POST['hotelFaculty'];
    $totalDiem = $_POST['diemDean'] + $_POST['diemChair'] +  $_POST['diemFaculty'];


$QUERY = mysqli_query($conn, "SELECT * FROM mustattend
INNER JOIN mas_breakdown
ON mustattend.mas_id = mas_breakdown.mas_list_id");

while($rows = mysqli_fetch_array($QUERY))
{
    $mas_id = $rows['mas_id'];

}

$update1 = "UPDATE mas_breakdown SET numofdean = '$numDean', numofchair = '$numChair', numoffaculty = '$numFaculty', deanHotel = '$hotelDean', chairHotel = '$hotelChair', facultyHotel = '$hotelFaculty', deanDiem = '$diemDean', chairDiem = '$diemChair', facultyDiem = '$diemFaculty' WHERE mas_list_id='$mas_id'";
mysqli_query($conn, $update1);
$dean_status = "New";
$update2 = "UPDATE mustattendremarks SET dean_status='$dean_status' where annualyear='$ay' AND department='$department'";
mysqli_query($conn, $update2);
$update3 = "UPDATE mustattend SET title = '$title', category = '$category', sponsor = '$sponsor' WHERE mas_id = '$mas_id'";
mysqli_query($conn, $update3);
/*
echo '<strong>'.$totalBudget = $_POST['budgetTotal'].'</strong>';

// $mas_id="";

if($conn==true){
            $mas_id = $mas_id - 1;
            $totalBudget = substr($totalBudget, 3);
            $result2 = mysqli_query($conn, "SELECT * FROM mustattend WHERE mas_id ='$mas_id'");
             $num_rows2 = mysqli_num_rows($result2);
             if($num_rows2 <= 0){
$update = "UPDATE mustattend
           SET title = '$title', category = '$category', sponsor = '$sponsor', dates= '$date', days='$days', venue='$venue', person='$person', budget='$totalBudget', transpo_total = '$Transtotal', reg_total = '$regtotal' where mas_id='$mas_id'";
                mysqli_query($conn, $update);

                $update1 = "UPDATE mas_breakdown SET numofdean='$numDean', numofchair='$numChair', numoffaculty='$numFaculty', deanHotel='$hotelDean', chairHotel='$hotelChair', facultyHotel='$hotelFaculty', deanDiem='$diemDean', chairDiem='$diemChair', facultyDiem='$diemFaculty' where mas_id='$mas_id'";
                mysqli_query($conn, $update1);
                $dean_note = "New";
                $dean_status = "Resend";

                $update2 = "UPDATE mustattendremarks SET dean_status='$dean_status' where annualyear='$ay' AND department='$department'";
                mysqli_query($conn,$update2);
             }
else{
                $dean_note = "New";
                $dean_status = "New";
                $vp_note="New";
                $vp_status="New";
                $hr_status="New";
                $inserts = "INSERT INTO mustattend(title, category, sponsor, dates, days,venue, person, academicyear, department, school, budget,dean_status, dean_note, vp_status, vp_note, hr_status, transpo_total, reg_total) VALUES ('$title', '$category', '$sponsor','$datecreated', '$days', '$venue', '$person', '$ay', '$department', '$school', '$totalBudget', '$dean_status', '$dean_note','$vp_status', '$vp_note', '$hr_status', '$Transtotal', '$regtotal')";
            mysqli_query($conn, $inserts);
            $inserts1 = "INSERT INTO mas_breakdown(numofdean, numofchair, numoffaculty, deanHotel, chairHotel,facultyHotel, deanDiem, chairDiem, facultyDiem, regfeeDean, regfeeChair, regfeeFaculty, transfeeDean, transfeeChair, transfeeFaculty) VALUES('$numDean', '$numChair','$numFaculty', '$hotelDean', '$hotelChair', '$hotelFaculty', '$diemDean', '$diemChair', '$diemFaculty', '$regDean', '$regChair', '$regFaculty', '$transpoDean', '$transpoChair', '$transpoFaculty')";

            mysqli_query($conn, $inserts1);
            // }else{
                
            //     die('fuck');
            // }   
            $result2 = mysqli_query($conn, "SELECT * FROM mustattendremarks WHERE dates ='$datecreated' AND department='$department'");
            while($row= mysqli_fetch_array($result2))
            {
                
            }
            $num_rows2 = mysqli_num_rows($result2);
            echo "No. of Rows : '$num_rows2'";
            if($num_rows2 <= $num_rows2){
            $inserts2 = "INSERT INTO mustattendremarks(department, annualyear, dates, dean_status, dean_note, vp_status, vp_note, hr_status) VALUES('$department','$ay','$datecreated','$dean_status','$dean_note','$vp_status','$vp_note','$hr_status')";
              mysqli_query($conn, $inserts2);
            }else{

    }
}
            $notification=$mas_id;

}else{
	echo "No Connection";
}

$out='{"notification":"'.$notification.'"}';
echo $out;
*/
echo " Acad. Year : '$ay'  / ";
echo " Date Created : '$datecreated'  / ";
echo " School : '$school'  / ";
echo " Department : '$department' / ";
echo " Seminar : '$title' / ";
echo " Category : '$category' / ";
echo " Sponsor : '$sponsor' / ";
echo " Date : '$date' / ";
echo " Days : '$days' / ";
echo " Venue : '$venue' / ";
echo " MAS ID : '$mas_id' / ";
echo " No. of Dean : '$numDean' / ";
echo " No. of Chair : '$numChair' / ";
echo " No. of Faculty : '$numFaculty' / ";
echo " Hotel Dean : '$hotelDean' / ";
echo " Hotel Chair : '$hotelChair' / ";
echo " Hotel Faculty : '$hotelFaculty' / ";
echo " Diem Dean : '$diemDean' / ";
echo " Diem Chair : '$diemChair' / ";
echo " Diem Faculty : '$diemFaculty' / ";
echo " Person : '$person' / ";
?>