<?php
// $totalTranspo = 0;
// $totalReg = 0;
// $budget = 0;
$dean_note = "New";
$dean_status = "New";
$vp_note="New";
$vp_status="New";
$hr_status="New";
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
require "config.php";
$conn = mysqli_connect('localhost', 'root', '', 'efs');

if(isset($_POST['transpoDean']) && isset($_POST['transpoChair']) && isset($_POST['transpoFaculty']))
{
    $transpoDean = $_POST['transpoDean'];
    $transpoChair = $_POST['transpoChair'];
    $transpoFaculty = $_POST['transpoFaculty'];

    if(!empty($deantrans) && !empty($chairtrans) && !empty($factrans))
    {
        $totalTranspo = $transpoDean + $transpoChair +  $transpoFaculty;
        $budget = $totalHotel + $totalDiem + $totalReg + $totalTranspo;
    }
    else
    {
        $totalTranspo = 0;
        $budget = 0;
    }
}
else
{
    $transpoDean = 0;
    $transpoChair = 0;
    $transpoFaculty = 0;
}

if(isset($_POST['regDean']) && isset($_POST['regChair']) && isset($_POST['regFaculty']))
{
    $regDean = $_POST['regDean'];
    $regChair = $_POST['regChair'];
    $regFaculty = $_POST['regFaculty'];

    if(!empty($deantrans) && !empty($chairtrans) && !empty($factrans))
    {
        $totalReg = $regDean + $regChair +  $regFaculty;
        $budget = $totalHotel + $totalDiem + $totalReg + $totalTranspo;
    }
    else
        {
            $totalReg = 0;
            $budget = 0;
        }
}
else
{
    $regDean = 0;
    $regChair = 0;
    $regFaculty = 0;
}

$ay = $_POST['ay'];
$datecreated = $_POST['datecreated'];
$school = $_POST['school'];
$department = $_POST['department'];
$title = $_POST['title'];
$category = $_POST['category'];
$sponsor = $_POST['sponsor'];
//$date = $_POST['date'];
$days = $_POST['days'];
$venue = $_POST['venue'];

$person = $_POST['numDean'] + $_POST['numChair'] + $_POST['numFaculty'];
$totalHotel = $_POST['hotelDean'] + $_POST['hotelChair'] +  $_POST['hotelFaculty'];
$totalDiem = $_POST['diemDean'] + $_POST['diemChair'] +  $_POST['diemFaculty'];


$numDean = $_POST['numDean'];
$numChair = $_POST['numChair'];
$numFaculty = $_POST['numFaculty'];
$hotelDean = $_POST['hotelDean'];
$hotelChair = $_POST['hotelChair'];
$hotelFaculty = $_POST['hotelFaculty'];
$diemDean = $_POST['diemDean'];
$diemChair = $_POST['diemChair'];
$diemFaculty = $_POST['diemFaculty'];


$mas_id="";

// $result = mysqli_query($conn, "SELECT mas_list_id FROM mas_breakdown");
// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// $masListId = $row['mas_list_id'];

// $result1 = mysqli_query($conn, "SELECT * FROM mustattend WHERE mas_id = '$masListId'");
// $row1 = mysqli_fetch_array($result1);
// if($row1 >= 1)
// {
    
// }
// else
// {
    if($conn==true){
    // if(($ay!=null)&&($datecreated!=null)&&($school!=null)&&($department!=null)&&($title!=null)&&($category!=null)&&($sponsor!=null)&&($date!=null)&&($days!=null)&&($venue!=null)&&($person!=null)&&($budget!=null)){

         $mas_id = "mas".time().rand();
         $budget = substr($budget, 3);
                
             $inserts = "INSERT INTO mustattend(title, category, sponsor, dates, days,venue, person, academicyear, department, school, budget,dean_status, dean_note, vp_status, vp_note, hr_status, transpo_total, reg_total) VALUES('$title', '$category', '$sponsor','$datecreated', '$days', '$venue', '$person', '$ay', '$department', '$school', '$budget', '$dean_status', '$dean_note','$vp_status', '$vp_note', '$hr_status', '$totalTranspo', '$totalReg')";
            mysqli_query($conn, $inserts);
            $inserts1 = "INSERT INTO mas_breakdown(numofdean, numofchair, numoffaculty, deanHotel, chairHotel,facultyHotel, deanDiem, chairDiem, facultyDiem, regfeeDean, regfeeChair, regfeeFaculty, transfeeDean, transfeeChair, transfeeFaculty) VALUES('$numDean', '$numChair','$numFaculty', '$hotelDean', '$hotelChair', '$hotelFaculty', '$diemDean', '$diemChair', '$diemFaculty', '$regDean', '$regChair', '$regFaculty', '$transpoDean', '$transpoChair', '$transpoFaculty')";
         
          mysqli_query($conn, $inserts1);
           
                
            // }else{
             
            // }   
            $result2 = mysqli_query($conn, "SELECT * FROM mustattendremarks WHERE dates ='$datecreated' AND department='$department'");
            while($row= mysqli_fetch_array($result2))
            {

            }
            $num_rows2 = mysqli_num_rows($result2);
            echo "No. of Rows : '$num_rows2'";
            if($num_rows2 <= 0){
            $inserts2 = "INSERT INTO mustattendremarks(department, annualyear, dates, dean_status, dean_note, vp_status, vp_note, hr_status) VALUES('$department','$ay','$datecreated','$dean_status','$dean_note','$vp_status','$vp_note','$hr_status')";
              mysqli_query($conn, $inserts2);


            
    // }else{
    //     // echo "Do not leave blank form";
    //     $notification="Dont leave form blank";
    // }
}else{
    echo "Go Home";
}
}
// }

$notification = 'Added Succesfully';
$out='{"notification":"'.$notification.'"}';
echo $out;
?>