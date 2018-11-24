<?php
    include("db/config.php");
    include("action/session-auth.php");
    include("include/head.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>
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
                        <li class="active">Must-Attend</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>Academic Year</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="hoverRow">
                                    <?php
                                      // require "db/config.php";
                                         $conn = mysqli_connect("localhost","root","","efs");
                                        $departments = $college;
                                        
                                        $result = mysqli_query($conn,"SELECT * FROM mustattendremarks where department='$departments' order by id DESC");

                                        while($row = mysqli_fetch_array($result)){
                                            
                                            echo '<tr class="viewRow">';
                                            echo '<td>';
                                            echo $row['annualyear'];
                                            echo '</td>';
                                            echo '<td>';
                                            echo $row['dates'];
                                            echo '</td>';
                                             echo '<td>';

                                             $dean_status = $row['dean_status'];
                                             $vp_status = $row['vp_status'];
                                             $hr_status = $row['hr_status'];
                                            if(($dean_status=="New")&&($vp_status=="New")&&($hr_status=="New")){
                                               echo '<a href="#"class="btn btn-success">New Must-Attend Seminar. Pending for your feedback <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="New")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-warning">Feedback sent. Waiting for chair'."'s". ' revision <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-warning">Feedback sent. Waiting for chair'."'s". ' revision <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="New")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-success">Revised must attend  seminar from chair <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-success">Revised must attend  seminar from chair <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="New")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-success">Approved. Waiting for vpar'."'s". ' approval <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Resend")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-success">Approved. Waiting for vpar'."'s". ' approval <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-warning">Need revision from VPAR <i class="fa fa-sign-out"></i></a>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="New")){
                                                echo '<a href="#" class="btn btn-success">Approved by VPAR <i class="fa fa-check"></i></a>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="Approved")){
                                                echo '<a href="#" class="btn btn-success">Submitted to HR <i class="fa fa-check"></i></a>';
                                            }

                                            echo '</td>';
                                            
                                            echo '<td>';
                                            // if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="New")){
                                            //     echo '<button class="btn btn-primary" id="';
                                            //     echo $row['annualyear'];
                                            //     echo '" onClick="confirmSubmit(this.id)" data-toggle="modal" data-target="#mustReturn">Submit to HR  <i class="fa fa-paper-plane"></i></button>';
                                            // }else{
                                             echo '<form action="db/db_viewMAS.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                                    echo '<input type="text" name="annualyear" value="';
                                                        echo $row['annualyear'];
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                    echo '<button type="submit" class="btn btn-success">View Details  <i class="fa fa-folder-open"></i></button>';
                                                    echo '</form>';
                                            // }
                                            // if(($dean_status=="New")&&($vp_status=="New")){
                                            //          echo '<form action="db/db_viewMAS.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                            //         echo '<input type="text" name="annualyear" value="';
                                            //             echo $row['annualyear'];
                                            //             echo '" style="width:1px;visibility:hidden;">';
                                            //         echo '<button type="submit" class="btn btn-success">Open  <i class="fa fa-folder-open"></i></button>';
                                            //         echo '</form>';
                                            // }else if (($row['dean_status']=="Revision")){
                                            //      echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                            // }else if (($row['dean_status']=="Approved")&&($vp_status=="New")){
                                            //     echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                            // }else if (($row['dean_status']=="Approved")&&($vp_status=="Revision")){
                                            //          echo '<form action="db/db_viewMAS.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                            //         echo '<input type="text" name="annualyear" value="';
                                            //             echo $row['annualyear'];
                                            //             echo '" style="width:1px;visibility:hidden;">';
                                            //         echo '<button type="submit" class="btn btn-success">Open  <i class="fa fa-folder-open"></i></button>';
                                            //         echo '</form>';
                                            // }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="New")){
                                                
                                            //     echo '<button class="btn btn-primary" id="';
                                            //     echo $row['annualyear'];
                                            //     echo '" onClick="confirmSubmit(this.id)" data-toggle="modal" data-target="#mustReturn">Submit to HR  <i class="fa fa-paper-plane"></i></button>';
                                              
                                            // }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="Approved")){
                                            //     echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                            // }
                                           
                                           
                                            echo '</td>';
                                        echo '</tr>';
                                            
                                        }
                                            
                                    ?>
                                   
                                        
                                    </tbody>
                                </table>
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

     <!-- Must-Attend Modal Return-->
    <div class="modal" id="mustReturn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                     <form action="db/db_submitMAS.php" method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class="col-sm-12 text-center">
                        <h4>Are you sure?</h4>
                        <h5 class="text-muted">Once <strong class="text-success">submit</strong>, this request will automatically visible to <strong class="text-primary">HR</strong>.</h5>
                    </div>
                     <div class="col-sm-12 text-center">
                        <input type="text" id="annualid" name="annual" ><!-- style="visibility:hidden;" -->
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

    <?php
        include('include/foot.php');
    ?>

</body>

</html>