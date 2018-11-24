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
                        <li class="active">Must-Attend</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <p>
                <a href="maCreates.php" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
            </p>
                

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                    <?php
                        $result = mysql_query("SELECT * FROM mustattendremarks where department='$college' order by id DESC");
                        while($row = mysql_fetch_array($result)){
                        $academicyear= $row['annualyear'];
                        $open;
                        echo '<div class="col-sm-6">';
                            echo '<div class="panel panel-default panelHover">';
                                    echo '<div class="panel-body">';
                                        echo '<div class="row">';
                                            echo '<div class="col-sm-8 col-xs-8">';
                                                echo '<h3>School Year</h3>';
                                                echo '<h4>';
                                                echo $row['annualyear'];
                                                echo '</h4>';
                                                echo '<p class="text-muted">Created on ';
                                                echo $row['dates'];
                                                echo '</p>';
                                                // echo '<p class="text-muted">Delivered on Sept. 07, 2015 at 10:27pm</p>';
                                            echo '</div>';
                                            echo '<div class="col-sm-4 col-xs-4 text-right text-warning">';
                                             $dean_status = $row['dean_status'];
                                             $vp_status = $row['vp_status'];
                                             $hr_status = $row['hr_status'];
                                            if(($dean_status=="New")&&($vp_status=="New")&&($hr_status=="New")){
                                              echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="New")&&($hr_status=="New")){
                                                 echo '<i style="color:red;" class="fa fa-pencil-square-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                 echo '<i style="color:red;" class="fa fa-pencil-square-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="New")&&($hr_status=="New")){
                                                 echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="New")&&($hr_status=="New")){
                                                 echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Resend")&&($hr_status=="New")){
                                                 echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="New")){
                                                echo '<i style="color:blue;" class="fa fa-check-circle-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="Approved")){
                                               echo '<i style="color:blue;" class="fa fa-check-circle-o fa-5x"></i>';
                                            }

                             
                                                echo '<p>';
                                             if(($dean_status=="New")&&($vp_status=="New")&&($hr_status=="New")){
                                              echo "Pending Approval";
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="New")&&($hr_status=="New")){
                                                echo "For revision";
                                            }else if (($row['dean_status']=="Revision")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                  echo "For revision";
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="New")&&($hr_status=="New")){
                                                 echo "Pending Approval";
                                            }else if (($row['dean_status']=="Resend")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                echo "Pending Approval";
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="New")&&($hr_status=="New")){
                                               echo "Pending Approval";
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Resend")&&($hr_status=="New")){
                                                  echo "Pending Approval";
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Revision")&&($hr_status=="New")){
                                                 echo "Pending Approval";
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="New")){
                                               echo "Approved";
                                            }else if (($row['dean_status']=="Approved")&&($vp_status=="Approved")&&($hr_status=="Approved")){
                                              echo "Approved";
                                            }

                                                 
                                          

                                               
                                                echo '</p>';
                                                
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '<a href="mustAttend.php" class="text-muted">';
                                    echo '<div class="panel-footer">';
                                        echo '<span class="pull-left">';
                                            echo '<h4><strong>';
                                $counter=0;
                        $result = mysql_query("SELECT * FROM mustattend where department='$college' AND academicyear='$academicyear'");
                            while($row = mysql_fetch_array($result)){
                                $counter++;
                            }

                                echo '<form action="db_viewmustattend.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                echo $counter;
                                            echo '</strong> seminars included</h4>';
                                        echo '</span>';
                                        echo '<span class="pull-right text-primary">';
                                        // btn-block
                                         // 
                                        echo '<input type="text" style="width:1px;visibility:hidden;" name="academicyear" value="';
                                        echo $academicyear;
                                        echo '">';
                                         echo '<button type="submit" class="btn btn-success"><i class="fa fa-arrow-circle-right fa-2x"></i></button>';
                                            // echo '<i class="fa fa-arrow-circle-right fa-3x"></i>';
                                        echo '</span>';
                                        // echo '</form>';
                                        echo '<div class="clearfix"></div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                        }
                        ?>
                      
                    </div>
                </div>
            </div>    

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- Pending Modal -->
    <div class="modal fade" id="pending" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Title: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE National Conference (NATCON)
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Category: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Research
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Sponsoring Org: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE Nat'l
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Venue: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Philippines
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">Panel reserved for fees</div>
                        <!-- <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active">Fee</th>
                                        <th class="active">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Registration Fee
                                        </td>
                                        <td>
                                            P5500 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Transportation Air Fee 
                                        </td>
                                        <td>
                                            5000 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Hotel Accommodation
                                        </td>
                                        <td>
                                            0 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            PER DIEM
                                        </td>
                                        <td>
                                            1500 <strong>x 5</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <h4 class="col-sm-6 pull-right">
                                <p>
                                    Total Cost: 
                                    <span class="pull-right">P 15, 900.00</span>
                                </p>
                            </h4>
                        </div> -->

                        <div class="row">
                            <div class="col-sm-7">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Persons Involved</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group" style="height: 300px;overflow-y:auto;">
                                            <a href="#" class="list-group-item">
                                                <strong>Rodrigo Duterte</strong>
                                                <p class="list-group-item-text text-muted">President of the Philippines</p>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <strong>Nancy Robredo</strong>
                                                <p class="list-group-item-text text-muted">Vice President of the Philippines</p>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <strong>CCIT (College of Computing in Information Technology)</strong>
                                                <p class="list-group-item-text text-muted">College Department</p>
                                            </a>
                                        </div>
                                       <!--  <button id="showAllPerson" class="btn btn-default btn-block" style="">
                                            <i class="fa fa-chevron-down"></i>
                                        </button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                 <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Day</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <p class="col-sm-6">
                                                    <strong>Estimated Date: </strong>
                                                </p>
                                                <p class="col-sm-6">
                                                    Jan. 02, 2017
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-6">
                                                    <strong>Number of Days: </strong>
                                                </p>
                                                <p class="col-sm-6">
                                                    5
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <button class="btn btn-warning btn-block">Waiting for approval <i class="fa fa-sign-out"></i></button>
                                            <h6 class="small text-muted text-center"><i class="fa fa-check"></i> Seen 11:34pm</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Print</button> -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Revision Modal -->
    <div class="modal fade" id="revision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Title: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE National Conference (NATCON)
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Category: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Research
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Sponsoring Org: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE Nat'l
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Venue: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Philippines
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">Panel reserved for fees</div>
                        <!-- <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active">Fee</th>
                                        <th class="active">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Registration Fee
                                        </td>
                                        <td>
                                            5500 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Transportation Air Fee 
                                        </td>
                                        <td>
                                            5000 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Hotel Accommodation
                                        </td>
                                        <td>
                                            0 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            PER DIEM
                                        </td>
                                        <td>
                                            1500 <strong>x 5</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <h4 class="col-sm-6 pull-right">
                                <p>
                                    Total Cost: 
                                    <span class="pull-right">P 15, 900.00</span>
                                </p>
                            </h4>
                        </div> -->

                        <div class="row">
                            <div class="col-sm-7">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Persons Involved</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group" style="height: 300px;overflow-y:auto;">
                                            <a href="#" class="list-group-item">
                                                <strong>Rodrigo Duterte</strong>
                                                <p class="list-group-item-text text-muted">President of the Philippines</p>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <strong>Nancy Robredo</strong>
                                                <p class="list-group-item-text text-muted">Vice President of the Philippines</p>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <strong>CCIT (College of Computing in Information Technology)</strong>
                                                <p class="list-group-item-text text-muted">College Department</p>
                                            </a>
                                        </div>
                                       <!--  <button id="showAllPerson" class="btn btn-default btn-block" style="">
                                            <i class="fa fa-chevron-down"></i>
                                        </button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                 <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Day</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <p class="col-sm-6">
                                                    <strong>Estimated Date: </strong>
                                                </p>
                                                <p class="col-sm-6">
                                                    Jan. 02, 2017                                                
                                                    <!-- <del class="text-danger">Jan. 02, 2017</del>
                                                    <br>
                                                    <ins class="text-primary">Jan. 02, 2017</ins> -->
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-6">
                                                    <strong>Number of Days: </strong>
                                                </p>
                                                <p class="col-sm-6">
                                                    5
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <button class="btn btn-warning btn-block">For revision <i class="fa fa-paperclip"></i></button>
                                            <h6 class="small text-muted text-center"><i class="fa fa-check"></i> 11:34pm</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea cols="30" rows="10" class="form-control" readonly>Yes. It is GOOD.</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Remarks by:</h3>
                                    </div>
                                    <div class="panel-body">
                                        <span class="text-center">
                                            <h4>Andy G. Lim</h4>
                                            <h5 class="text-muted">VPAR Foot</h5>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="maRevise.php" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Revise</a>
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
    <script>
        // $(function(){

        //     var lastCount = 0;

        //     setInterval(function(){
        //         $.ajax({
        //             type: 'POST',
        //             url: 'action/notif.php',
        //             data: {
        //                 lastCount: lastCount
        //             },
        //             success: function(response){
        //                 if(lastCount!=response){
        //                     console.log("New Data has been added!");
        //                     $('#titleCount').prepend('('+response+')');
        //                     $('#notifCount').html(response);
        //                     lastCount = response;

        //                     $.gritter.add({
        //                         title: lastCount+' New notification!',
        //                         text: 'Content of Notification',
        //                         sticky: false
        //                     });

        //                 }else{
        //                     console.log(response);
        //                 }
        //             },
        //             error: function(){
        //                 console.log("AW");
        //             }
        //         });
        //     },);
        // });
    </script>

</body>



</html>

