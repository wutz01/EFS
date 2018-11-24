<?php
    include("db/config.php");
    include("action/session-auth.php");
    include("include/head.php");
?>
<!DOCTYPE html>
<html lang="en">

<title> E-FSDP | Acadhead</title>

<body>

<div id="wrapper">

<?php
    include("include/nav.php");
?>

<div id="page-wrapper">

        <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Must-Attend
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="">
                            <i class="fa fa-book"></i> Manage
                        </a>
                    </li>
                    <li class="active">
                        <a href="maList.php">
                            Must-Attend
                        </a>
                    </li>
                    <li class="active">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                            $annual=$_SESSION['ay'];
                            $college=$_SESSION['departments'];
                             $result = mysqli_query($conn, "SELECT * FROM mustattendremarks where department='$college' AND annualyear ='$annual' order by id DESC");
                             $row = mysqli_fetch_array($result);
                             $annualyear = $_SESSION['ay'];
                             $datecreated = $row['dates'];
                             echo $annualyear;
                        ?>


                    </li>
                </ol>
            </div>
        </div>

        
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <p class="col-sm-4">
                                <strong>Academic Year: </strong>
                            </p>
                            <p class="col-sm-8">
                            <?php
                                echo $annualyear;

                            ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <p class="col-sm-3">
                                <strong>Date Created: </strong>
                            </p>
                            <p class="col-sm-9">
                              <?php
                                echo $datecreated;
                            ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <p class="col-sm-4">
                                <strong>School: </strong>
                            </p>
                            <p class="col-sm-8">
                            <?php
                                if((strtoupper($college)=="CCIT")||(strtoupper($college)=="COE")||(strtoupper($college)=="COPS")){
                                    echo "School of Technology";
                                }else if((strtoupper($college)=="CAS"))
                                {
                                    echo "School of Humanities";
                                }else if((strtoupper($college)=="CBA"))
                                {
                                    echo "School of Management";
                                }
                                
                            ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <p class="col-sm-3">
                                <strong>Department: </strong>
                            </p>
                            <p class="col-sm-9">
                            <?php
                                echo $college;
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $result1 = mysqli_query($conn, "SELECT * FROM mustattendremarks where department='$college' AND annualyear='$ay'");
                        $row1 = mysqli_fetch_array($result1);
                        $deanStatus=$row1['dean_status'];
                        $vpStatus = $row1['vp_status'];
                        $hrStatus=$row1['hr_status'];
                        if(($deanStatus=="New")&&($vpStatus=="New")&&($hrStatus=="New")){
                            echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                            echo ' <span style="color:orange;">Pending</span>';
                            echo '</h4>';
                        }else  if(($deanStatus=="Revision")&&($vpStatus=="New")&&($hrStatus=="New")){
                            echo '<i style="color:red;" class="fa fa-pencil-square-o "></i>';
                             echo ' <span style="color:red;">For revision</span>';
                            echo '</h4>';
                        }else  if(($deanStatus=="Resend")&&($vpStatus=="New")&&($hrStatus=="New")){
                            echo '<i  style="color:orange;" class="fa fa-clock-o "></i>';
                            echo ' <span style="color:orange;">Pending</span>';
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Approved")&&($vpStatus=="New")&&($hrStatus=="New")){
                            echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                            echo " <span style='color:orange;'>Pending (VPAR"."'s Approval)</span>";
                            echo '</h4>';
                        }else  if(($deanStatus=="Approved")&&($vpStatus=="Revision")&&($hrStatus=="New")){
                             echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                            echo " <span style='color:orange;'>Pending</span>";
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Revision")&&($vpStatus=="Revision")&&($hrStatus=="New")){
                             echo '<i style="color:red;" class="fa fa-pencil-square-o "></i>';
                             echo ' <span style="color:red;">For revision</span>';
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Resend")&&($vpStatus=="Revision")&&($hrStatus=="New")){
                             echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                             echo ' <span style="color:orange;">Pending</span>';
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Approved")&&($vpStatus=="Resend")&&($hrStatus=="New")){
                             echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                             echo ' <span style="color:orange;">Pending</span>';
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Approved")&&($vpStatus=="Approved")&&($hrStatus=="New")){
                             echo '<i style="color:orange;" class="fa fa-clock-o "></i>';
                             echo ' <span style="color:orange;">Pending</span>';
                            echo '</h4>';
                           
                        }else  if(($deanStatus=="Approved")&&($vpStatus=="Approved")&&($hrStatus=="Approved")){
                             echo '<i style="color:blue;" class="fa fa-check-circle-o "></i>';
                             echo ' <span style="color:blue;">Approved</span>';
                            echo '</h4>';
                           
                        }
                       

                      ?>  
					<?php
                          $conn = mysqli_connect("localhost", "root", "", "efs");
                                        // $departments = $college;
                          $result1 = mysqli_query($conn,"SELECT * FROM mustattendremarks where department='$college'");
                           $row1 = mysqli_fetch_array($result1);

                           $dean=$row1['dean_status'];
                           $vp =$row1['vp_status'];


                         ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="active">
                                <th style="width:20%">Title</th>
                                <th style="width:10%">Category</th>
                                <th style="width:10%">Sponsoring Org</th>
                                <th style="width:10%">Date</th>
                                <th style="width:10%">Days</th>
                                <th style="width:10%">Venue</th>
                                <th style="width:10%">Person's Involved</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php
                         $conn = mysqli_connect('localhost', 'root', '', 'efs');
                            $annualyear = $_SESSION['ay'];
                             $result = mysqli_query($conn, "SELECT * FROM mustattend where department='$college' AND academicyear='$annualyear'");
                             while ($row = mysqli_fetch_array($result)){
                              echo '<tr>';
                                   echo '<td style="width:20%">';
                                   echo $row['title'];
                                   echo '</td>';
                                   echo '<td style="width:10%">';
                                   echo $row['category'];
                                   echo '</td>';
                                   echo '<td style="width:10%">';
                                   echo $row['sponsor'];
                                   echo '</td>';
                                   echo '<td style="width:10%">';
                                   echo $row['dates'];
                                   echo '</td>';
                                   echo '<td style="width:10%">';
                                   echo $row['days']." days";
                                   echo '</td>';
                                   echo '<td style="width:20%">';
                                   echo $row['venue'];
                                   echo '</td>';
                                   echo '<td style="width:10%">';
                                   echo $row['person'];
                                   echo '</td>';
                                  
                                     echo '<td style="width:10%">';
                                  echo '<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#';
                                  echo $row['mas_id'];
                                  echo '">View more  <i class="fa fa-eye"></i></button>';
                                   echo '</td>';
                                   
                                   if((($dean=="New")&&($vp=="New"))||(($dean=="Resend")&&($vp=="New"))||(($dean=="Approved")&&($vp=="Revision"))||(($dean=="Resend")&&($vp=="Revision"))){
                                        echo '<td>';
                                   echo '<input type="checkbox" id="';
                                   echo $row['mas_id'];
                                   echo '" ';
                                   echo '<input id="text';
                                   echo $row['mas_id'];
                                   echo '" type="text">';
                                   echo '</td>';
                                    }
                              echo '</tr>';
                             }
                         
                        ?>
                           
                        </tbody>
                    </table>
                </div>
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'efs');
                   $result1 = mysqli_query($conn, "SELECT * FROM mustattendremarks where department='$college' AND annualyear='$annualyear'");
                           $row1 = mysqli_fetch_array($result1);

                           $dean=$row1['dean_status'];
                           $vp =$row1['vp_status'];
                            if((($dean=="Approved")&&($vp=="New"))||(($dean=="Approved")&&($vp=="Resend"))){
                               echo '<div class="row">';
                                echo '<div class="col-sm-12">';
                                    echo '<div class="col-sm-8">';
                                        echo '<div class="form-group">';
                                            echo '<label>Remarks: </label>';
                                            echo '<textarea cols="30" rows="10" id="remarks" class="form-control"></textarea>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            }

                ?>
               
                
                <hr>
                <div class="row">
                    <div class="col-sm-7 text-right">
                        
                    </div>
                    <div class="col-sm-5 text-right">
                         <div class="row">
                             <?php
                             $conn = mysqli_connect('localhost', 'root', '', 'efs');
                              $result1 = mysqli_query($conn, "SELECT * FROM mustattendremarks where department='$college' AND annualyear='$annualyear'");
                           $row1 = mysqli_fetch_array($result1);

                           $dean=$row1['dean_status'];
                           $vp =$row1['vp_status'];

                         // ||(($dean=="Approved")&&($vp=="Resend"))||(($dean=="Approved")&&($vp=="Revision"))||(($dean=="Resend")&&($vp=="Revision"))

                           if((($dean=="Approved")&&($vp=="New"))||(($dean=="Approved")&&($vp=="Resend"))){
                            echo '<div class="col-sm-6 text-right">';
                                    echo '<button class="btn btn-warning btn-lg" onClick="sendNotes()" data-toggle="modal" data-target="#mustReturn">';
                                        echo 'Return to Dean <i class="fa fa-arrow-circle-o-left"></i>';
                                    echo '</button>';
                            echo '</div>';
                            echo '<div class="col-sm-6 text-right">';
                                    echo '<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#mustConfirm">';
                                        echo 'Approved <i class="fa fa-arrow-circle-o-right"></i>';
                                    echo '</button>';
                            echo '</div> ';


                           }
                            

                         ?>
                         </div>
                    </div>
                    
                </div>
            </div>
        </div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
 <!-- Must-Attend Modal  Return-->
    <div class="modal" id="mustReturn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                     <form action="db/db_returnToDean.php" method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class="col-sm-12 text-center">
                        <h4>Are you sure?</h4>
                        <h5 class="text-muted">Once <strong class="text-success">return</strong>, this request will automatically return to <strong class="text-primary">DEAN</strong>.</h5>
                    </div>
                     <div class="col-sm-12 text-center">
                        <input type="text" id="notes" name="notes" style="visibility:hidden;">
                     </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <!-- <button type="button" class="btn btn-primary">
                        <i class="fa fa-mail-forward"></i> Forward to HR
                    </button> -->
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!-- View more details modal-->
<?php
      $conn = mysqli_connect("localhost","root","","efs");
                                // $departments = $college;
                          $result = mysqli_query($conn,"SELECT * FROM mustattend where department='$college'");
      while($row = mysqli_fetch_array($result)){
    echo '<div class="modal" id="';
    $masid=$row['mas_id'];
    echo $masid;
    echo '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    echo '<h4 class="modal-title" id="myModalLabel">';
                    echo $row['title'];
                    echo '</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div class="row">';      
                echo '<div class="col-sm-12">';
                  echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered">';
                        echo '<thead>';
                            echo '<tr class="active">';
                                echo '<th style="width:25%;">Person Involves</th>';
                                echo '<th style="width:15%;">Number of Head</th>';
                                echo '<th style="width:15%;">Hotel</th>';
                                echo '<th style="width:15%;">Diem</th>';
                                echo '<th style="width:15%;">Reg. Fee</th>';
                                echo '<th style="width:15%;">Transpo</th>';
                                
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                         
                             $result1 = mysqli_query($conn, "SELECT * FROM mas_breakdown where mas_list_id='$masid'");
                             $row1 = mysqli_fetch_array($result1);
                             if($row1['numofdean']>0){
                                echo '<tr>';
                                   echo '<td>';
                                   echo 'Dean';
                                   echo '</td>';
                                   echo '<td>';
                                   echo $row1['numofdean'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['deanHotel'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['deanDiem'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['regfeeDean'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['transfeeDean'];
                                   echo '</td>';
                                echo '</tr>';

                             }
                              if($row1['numofchair']>0){
                                echo '<tr>';
                                   echo '<td>';
                                   echo 'Chair';
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['numofchair'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['chairHotel'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['chairDiem'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['regfeeChair'];
                                   echo '</td>';
                                   echo '<td>';
                                   echo $row1['transfeeChair'];
                                   echo '</td>';
                                echo '</tr>';
                                
                             }
                              if($row1['numoffaculty']>0){
                                echo '<tr>';
                                   echo '<td>';
                                   echo 'Faculty/Staff';
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['numoffaculty'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['facultyHotel'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['facultyDiem'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['regfeeFaculty'];
                                   echo '</td>';
                                    echo '<td>';
                                   echo $row1['transfeeFaculty'];
                                   echo '</td>';
                                echo '</tr>';
                                
                             }

                              echo '<tr>';
                                   echo '<td>';
                                   echo '';
                                   echo '</td>';
                                    echo '<td>';
                                   echo 'Total: ';
                                   $totalperson = $row1['numofdean']+$row1['numofchair']+$row1['numoffaculty'];
                                   echo $totalperson;
                                   echo '</td>';
                                   echo '<td>';
                                    $totalHotel = $row1['deanHotel']+$row1['chairHotel']+$row1['facultyHotel'];

                                      $hotel = number_format($totalHotel);
                                     
                                   echo 'Total: &#8369;' .$hotel.'.00';
                                   echo '</td>';
                                   
                                    echo '<td>';
                                    $totalDiem = $row1['deanDiem']+$row1['chairDiem']+$row1['facultyDiem'];
                                    $diem = number_format($totalDiem);
                                   echo 'Total: &#8369;' .$diem.'.00';
                                   echo '</td>';
                                   
                                    echo '<td>';
                                    $totalReg = $row1['regfeeDean']+$row1['regfeeChair']+$row1['regfeeFaculty'];
                                    $reg= number_format($totalReg);
                                   echo 'Total: &#8369;' .$reg.'.00';
                                   echo '</td>';
                                    echo '<td>';
                                    $totalTranspo = $row1['transfeeDean']+$row1['transfeeChair']+$row1['transfeeFaculty'];
                                    $transpo = number_format($totalTranspo);
                                   echo 'Total: &#8369;' .$transpo.'.00';
                                   echo '</td>';
                                echo '</tr>';

                        echo '</tbody>';
                    echo '</table>';
                echo '</div>';

                echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered">';
                        echo '<thead>';
                            echo '<tr class="active">';
                                echo '<th style="width:40%;">Component</th>';
                                echo '<th style="width:20%;">Sub-total</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                                echo '<tr>';
                                echo '<td>';  
                                echo 'Hotel'; 
                                echo '</td>';
                                echo '<td>';  
                                echo '&#8369;' .$hotel.'.00'; 
                                echo '</td>';  
                                echo '</tr>';
                                 echo '<tr>';
                                echo '<td>';  
                                echo 'Diem'; 
                                echo '</td>';
                                 echo '<td>';  
                                echo '&#8369;' .$diem.'.00'; 
                                echo '</td>'; 
                                echo '</tr>';
                                 echo '<tr>';
                                echo '<td>';  
                                echo 'Registration Fee'; 
                                echo '</td>';
                                 echo '<td>';  
                                
                                echo '&#8369;' .$reg.'.00'; 
                                echo '</td>'; 
                                echo '</tr>';
                                 echo '<tr>';
                                echo '<td>';  
                                echo 'Transportation'; 
                                echo '</td>';
                                echo '<td>';  
                                
                                echo '&#8369;' .$transpo.'.00'; 
                                echo ' X 2';
                                echo '</td>'; 
                                echo '</tr>';
                                 echo '<tr>';
                               
                                echo '</tr>';
                                 echo '<tr>';
                                echo '<td style="background-color:yellow;" class="text-right">';  
                                echo 'Total Estimated Budget'; 
                                echo '</td>';
                                echo '<td style="background-color:yellow;">'; 
                                $totalbudget =$totalHotel+$totalDiem+$totalReg+($totalTranspo*2);
                                $budgetTotal =  number_format($totalbudget);     
                                echo '<strong>&#8369;' .$budgetTotal.'.00</strong>'; 
                                echo '</td>'; 
                                echo '</tr>';
                          echo '</tbody>';
                    echo '</table>';
                echo '</div>';

                            
                echo '</div>';
              
                echo '</div>';
                
                echo '</div>';
                echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                
                echo '</div>';
            echo '</div>';
            // <!-- /.modal-content -->
       echo ' </div>';
        // <!-- /.modal-dialog -->
    echo '</div>';
    echo '</div>';
  }// end of while
    ?>
    <!-- /.modal -->

<!-- Must-Attend Modal  COnfirm-->
    <div class="modal" id="mustConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                     <form action="db/db_submitToHr.php" method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class="col-sm-12 text-center">
                    <div class="col-sm-12 text-center">
                        <h4>Are you sure?</h4>
                        <h5 class="text-muted">Once <strong class="text-success">approved</strong>, this request will automatically forward to <strong class="text-primary">HR</strong>.</h5>
                    </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <!-- <button type="button" class="btn btn-primary">
                        <i class="fa fa-mail-forward"></i> Forward to HR
                    </button> -->
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

   

    <!-- Must-Attend Modal Return-->
    <!-- <div class="modal" id="mustReturn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                     <form action="db/db_returnToChair.php" method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class="col-sm-12 text-center">
                        <h4>Are you sure?</h4>
                        <h5 class="text-muted">Once <strong class="text-success">return</strong>, this request will automatically return to <strong class="text-primary">CHAIR</strong>.</h5>
                    </div>
                     <div class="col-sm-12 text-center">
                        <input type="text" id="notes" name="notes" style="visibility:hidden;">
                     </div>

                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <!-- <button type="button" class="btn btn-primary">
                        <i class="fa fa-mail-forward"></i> Forward to HR
                    </button> -->
                   <!-- </form> -->
                <!-- </div> -->
            <!-- </div> -->
            <!-- /.modal-content -->
        <!-- </div> -->
        <!-- /.modal-dialog -->
<!--     </div> --> -->
    <!-- /.modal -->

  <?php
        include('include/foot.php');
    ?>
</body>



</html>

