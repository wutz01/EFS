<?php
  include("../db/config.php");
if(isset($_POST['submit'])){

  if ($_FILES['emp']['size'] > 0) {

    $file = $_FILES['emp']['tmp_name'];
    $handle = fopen($file,"r");


    $file = $_FILES['emp']['tmp_name'];
    $handle = fopen($file,"r");

    while($data = fgetcsv($handle,1000,",","'"))
    {
        $email = $data[0];
        $password = $data[1];
        $usertype = $data[2];
        $lname = $data[3];
        $mname = $data[4];
        $fname = $data[5];
        $designation = $data[6];
        $college = $data[7];
        $school = $data[8];

        $query = mysql_query("INSERT INTO account (email,password,usertype) 
          VALUES ('$email','$password','$usertype') ");

        $query2 = mysql_query("INSERT INTO profile (email,lastname,middlename,firstname,designation,college,school) 
          VALUES ('$email','$lname','$mname','$fname','$designation','$college','$school') ");
    }

    // print_r($data);

    header("location: ../employee.php");

  }
}

?>
