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
                <a href="maCreatess.php"  class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Create New</a>
            </p>
            <p>
                <a href="create-ma.php"  class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Create New Update Form</a>
            </p>


            <div class="row">
                <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead>
                                <tr class="active">
                                    <th class="">School Year</th>
                                    <th class="">School</th>
                                    <th class="">Date Created</th>
                                    <th class="col-sm-">Status</th>
                                    <th class="col-sm-"></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php
                                $conn = mysqli_connect("localhost","root","","efs");
                                $departments = $college;
                             $result4 = mysqli_query($conn, "
                                SELECT * FROM mustattendremarks
                                WHERE department='$college'
                                ORDER BY id DESC");
                             while($row = mysqli_fetch_array($result4)){
                                $id = $row['id'];
                                $sy = $row['annualyear'];
                                $dateCreated = $row['dates'];
                                $dean_status = $row['dean_status'];
                                $vp_status = $row['vp_status'];
                                $hr_status = $row['hr_status'];

                                if(($dean_status=="New")&&($vp_status=="New")){
                                   $stat =  '<div class="status status-warning"><i class="fa fa-clock-o"></i> Pending Approval</div>';
                                }else if (($dean_status=="Revision")){
                                   $stat =  '<div class="status status-danger" style><i class="fa fa-pencil-square-o"></i> For revision</div>';
                                }else if (($hr_status=="Approved")){
                                   $stat =  '<div class="status status-success"><i class="fa fa-check-circle-o"></i> Approved</div>';
                                }else if (($dean_status=="Approved")){
                                   $stat =  '<div class="status status-warning"><i class="fa fa-clock-o"></i> Pending Approval</div>';
                                }


                             echo "
                                <tr class='dataRow' data-toggle='modal' data-target='#viewEmp' data-id='$id'>
                                    <td>$sy</td>
                                    <td>$college</td>
                                    <td>$dateCreated</td>
                                    <td>$dean_status</td>
                                    <td class='text-center'>
                                    <form action='mustAttend.php' method='post'>
                                    <input type ='text' name='ay' value='";
                                echo $sy;
                                echo "' style='width:1px;height:1px;visibility:hidden;'>
                                    <input type='submit' class='btn btn-default' value='View'></td>
                                </form>
                                </tr>
                                ";
                            }
                             ?>

                            </tbody>
                        </table>
                        </div>

                    <!-- <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $result = mysqli_query($conn, "SELECT * FROM mustattendremarks WHERE department='$college' ORDER BY id DESC");
                        while($row = mysqli_fetch_array($result)){
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

                                            if(($row['dean_status']=="New")&&($vp_status=="New")){
                                               echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Revision")){
                                                 echo '<i style="color:red;" class="fa fa-pencil-square-o fa-5x"></i>';
                                            }else if (($row['hr_status']=="Approved")){
                                                 echo '<i style="color:green;" class="fa fa-check-circle-o fa-5x"></i>';
                                            }else if (($row['dean_status']=="Approved")){
                                                 echo '<i class="fa fa-clock-o fa-5x"></i>';
                                            }


                                                echo '<p>';


                                            if(($row['dean_status']=="New")&&($vp_status=="New")){
                                               echo "Pending Approval";
                                            }else if (($row['dean_status']=="Revision")){
                                                 echo "For revision";
                                            }else if (($row['hr_status']=="Approved")){
                                                 echo "Approved";
                                            }else if (($row['dean_status']=="Approved")){
                                                 echo "Pending Approval";
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
                        $result = mysqli_query($conn, "SELECT * FROM mustattend where department='$college' AND academicyear='$academicyear'");
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
                     -->
                   <!--  <div class="col-sm-6">
                        <div class="panel panel-default panelHover">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8">
                                            <h3>School Year</h3>
                                            <h4>2015 - 2016</h4>
                                            <p class="text-muted">Created on Jun. 07, 2015</p>
                                            <p class="text-muted">Approved on Jun. 12, 2015 at 10:27pm</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 text-right text-success">
                                            <i class="fa fa-check-circle fa-5x"></i>
                                            <p>Approved</p>
                                            <p class="text-muted small">
                                                <i class="fa fa-check"></i>Dean
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <a href="" class="text-muted">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                        <h4><strong>12</strong> seminars included</h4>
                                    </span>
                                    <span class="pull-right text-primary">
                                        <i class="fa fa-arrow-circle-right fa-3x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> -->
                   <!--  <div class="col-sm-6">
                        <div class="panel panel-default panelHover">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8">
                                            <h3>School Year</h3>
                                            <h4>2013 - 2014</h4>
                                            <p class="text-muted">Created on Sept. 07, 2014</p>
                                            <p class="text-muted">Approved on Sept. 12, 2014 at 10:27pm</p>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 text-right text-success">
                                            <i class="fa fa-check-circle fa-5x"></i>
                                            <p>Approved</p>
                                            <p class="text-muted small"> -->
                                                <!-- <i class="fa fa-check"></i>10:27pm -->
                            <!--                 </p>
                                        </div>
                                    </div>
                                </div>
                            <a href="" class="text-muted">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                        <h4><strong>8</strong> seminars included</h4>
                                    </span>
                                    <span class="pull-right text-primary">
                                        <i class="fa fa-arrow-circle-right fa-3x"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> -->
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
        $(function(){

            var lastCount = 0;

            setInterval(function(){
                $.ajax({
                    type: 'POST',
                    url: 'action/notif.php',
                    data: {
                        lastCount: lastCount
                    },
                    success: function(response){
                        if(lastCount!=response){
                            console.log("New Data has been added!");
                            $('#titleCount').prepend('('+response+')');
                            $('#notifCount').html(response);
                            lastCount = response;

                            $.gritter.add({
                                title: lastCount+' New notification!',
                                text: 'Content of Notification',
                                sticky: false
                            });

                        }else{
                            console.log(response);
                        }
                    },
                    error: function(){
                        console.log("AW");
                    }
                });
            },1500)0;
        });
    </script>

</body>



</html>
