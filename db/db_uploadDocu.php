<?php
require "config.php";




    if($conn==true){
        

        $docu =$_FILES["docu"]["name"];   
        $docutype =$_FILES["docu"]["type"];
        $docusize =$_FILES["docu"]["size"];
        $docutempfile =$_FILES["docu"]["tmp_name"];
        $docuerror =$_FILES["docu"]["error"];

            if($docuerror>0){
                           
            }else{
                if($docutype=="image/png" || $docutype=="image/jpg"|| $docutype=="image/jpeg" ||$docusize==200000){

                               
                                    $boom = explode(".", $docu);
                                    $filext = end($boom);
                                    $filename = time().rand().".".$filext;

                                    $email=$_POST['email'];
                                    $jobid=$_POST['jobid'];
                                   
                                    $inserts2 = "Insert into tna_docu values ('','$email','$jobid','$filename')";
                                mysql_query($inserts2,$conn);
                                    move_uploaded_file($docutempfile, "../docuimage/".$filename);

                               
                }else{
                    $_SESSION['notif']="3";
                }
            }

            $_SESSION["notif"]="8";
    }else{
            $_SESSION["notif"]="4";
    }
   

   header("Location: ../tnaUpload.php");

?>