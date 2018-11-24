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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Must-Attend Seminars</div>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#sot" data-toggle="tab">SOT</a></li>
                                <li><a href="#som" data-toggle="tab">SOM</a></li>
                                <li><a href="#soh" data-toggle="tab">SOH</a></li>
                            </ul>
                            <br>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="sot">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="active">
                                                            <th>Academic Year</th>
                                                            <th>College</th>
                                                            <th>Date Created</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="hoverRow">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $college1="CCIT";
                        $college2="COE";
                        $college3="COPS";
                        $status="Approved";
                        $status1="Revision";
                        $status2="Resend";
                        $result = mysqli_query($conn, "SELECT * FROM mustattendremarks where (department='$college1' OR department='$college2' OR department='$college3') AND hr_status='$status' order by id DESC");
                        while($row = mysqli_fetch_array($result)){
                            $departments = $row['department'];
                            
                                    echo '<tr class="viewRow">';
                                        echo '<td>';
                                        echo $row['annualyear'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['department'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['dates'];
                                        echo '</td>';
                                        echo '<td>';
                                             $dean_status = $row['dean_status'];
                                             $vp_status = $row['vp_status'];
                                             $hr_status = $row['hr_status'];
                                        
                                                                // <!-- <button class="btn btn-warning">Pending for feedback <i class="fa fa-sign-out"></i></button> -->
                                       if(($dean_status=="approved")&&($vp_status=="approved")&&($hr_status=="approved")){
                                               echo '<a href="#"class="btn btn-success">Approved <i class="fa fa-check"></i></a>';
                                        }
                                        
                                        echo '</td>';
                                         echo '<td>';
                                            
                                       
                                                echo '<form action="db/db_viewMASHR.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                                    echo '<input type="text" name="annualyear" value="';
                                                        echo $row['annualyear'];
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                        echo '<input type="text" name="department" value="';
                                                        echo $departments;
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                    echo '<button type="submit" class="btn btn-success">View Details  <i class="fa fa-folder-open"></i></button>';
                                                    echo '</form>';
                                        // }else if(($vp_status=="Revision")){
                                        //         echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                        // }else if(($vp_status=="Approved")){
                                        //         echo '<form action="db/db_viewMASVPar.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                        //             echo '<input type="text" name="annualyear" value="';
                                        //                 echo $row['annualyear'];
                                        //                 echo '" style="width:1px;visibility:hidden;">';
                                        //             echo '<button type="submit" class="btn btn-success">Open  <i class="fa fa-folder-open"></i></button>';
                                        //             echo '</form>';
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
                                <div class="tab-pane fade" id="som">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="active">
                                                            <th>Academic Year</th>
                                                            <th>College</th>
                                                            <th>Date Created</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="hoverRow">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $college1="CIHM";
                        $status="Approved";
                        $status1="Revision";
                        $status2="Resend";
                        $result = mysqli_query($conn, "SELECT * FROM mustattendremarks where (department='$college1') AND hr_status='$status' order by id DESC");
                        while($row = mysqli_fetch_array($result)){
                            $departments = $row['department'];
                            
                                    echo '<tr class="viewRow">';
                                        echo '<td>';
                                        echo $row['annualyear'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['department'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['dates'];
                                        echo '</td>';
                                        echo '<td>';
                                             $dean_status = $row['dean_status'];
                                             $vp_status = $row['vp_status'];
                                             $hr_status = $row['hr_status'];
                                        
                                                                // <!-- <button class="btn btn-warning">Pending for feedback <i class="fa fa-sign-out"></i></button> -->
                                       if(($dean_status=="approved")&&($vp_status=="approved")&&($hr_status=="approved")){
                                               echo '<a href="#"class="btn btn-success">Approved <i class="fa fa-check"></i></a>';
                                        }
                                        
                                        echo '</td>';
                                         echo '<td>';
                                            
                                       
                                                echo '<form action="db/db_viewMASHR.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                                    echo '<input type="text" name="annualyear" value="';
                                                        echo $row['annualyear'];
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                        echo '<input type="text" name="department" value="';
                                                        echo $departments;
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                    echo '<button type="submit" class="btn btn-success">View Details  <i class="fa fa-folder-open"></i></button>';
                                                    echo '</form>';
                                        // }else if(($vp_status=="Revision")){
                                        //         echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                        // }else if(($vp_status=="Approved")){
                                        //         echo '<form action="db/db_viewMASVPar.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                        //             echo '<input type="text" name="annualyear" value="';
                                        //                 echo $row['annualyear'];
                                        //                 echo '" style="width:1px;visibility:hidden;">';
                                        //             echo '<button type="submit" class="btn btn-success">Open  <i class="fa fa-folder-open"></i></button>';
                                        //             echo '</form>';
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
                                <div class="tab-pane fade" id="soh">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="active">
                                                            <th>Academic Year</th>
                                                            <th>College</th>
                                                            <th>Date Created</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="hoverRow">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $college1="CAS";
                        // $college3="COPS";
                        $status="Approved";
                        $status1="Revision";
                        $status2="Resend";
                        $result = mysqli_query($conn, "SELECT * FROM mustattendremarks where (department='$college1') AND hr_status='$status' order by id DESC");
                        while($row = mysqli_fetch_array($result)){
                            $departments = $row['department'];
                            
                                    echo '<tr class="viewRow">';
                                        echo '<td>';
                                        echo $row['annualyear'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['department'];
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['dates'];
                                        echo '</td>';
                                        echo '<td>';
                                             $dean_status = $row['dean_status'];
                                             $vp_status = $row['vp_status'];
                                             $hr_status = $row['hr_status'];
                                        
                                                                // <!-- <button class="btn btn-warning">Pending for feedback <i class="fa fa-sign-out"></i></button> -->
                                       if(($dean_status=="approved")&&($vp_status=="approved")&&($hr_status=="approved")){
                                               echo '<a href="#"class="btn btn-success">Approved <i class="fa fa-check"></i></a>';
                                        }
                                        
                                        echo '</td>';
                                         echo '<td>';
                                            
                                       
                                                echo '<form action="db/db_viewMASHR.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                                    echo '<input type="text" name="annualyear" value="';
                                                        echo $row['annualyear'];
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                        echo '<input type="text" name="department" value="';
                                                        echo $departments;
                                                        echo '" style="width:1px;visibility:hidden;">';
                                                    echo '<button type="submit" class="btn btn-success">View Details  <i class="fa fa-folder-open"></i></button>';
                                                    echo '</form>';
                                        // }else if(($vp_status=="Revision")){
                                        //         echo '<button class="btn btn-warning" disabled>Closed  <i class="fa fa-ban"></i></button>';
                                        // }else if(($vp_status=="Approved")){
                                        //         echo '<form action="db/db_viewMASVPar.php" method="post" class="form" role="form" enctype="multipart/form-data">';
                                        //             echo '<input type="text" name="annualyear" value="';
                                        //                 echo $row['annualyear'];
                                        //                 echo '" style="width:1px;visibility:hidden;">';
                                        //             echo '<button type="submit" class="btn btn-success">Open  <i class="fa fa-folder-open"></i></button>';
                                        //             echo '</form>';
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
                    </div>
                </div>
            </div>    

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
        include('include/foot.php');
    ?>

</body>

</html>