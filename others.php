<?php
include("action/session-auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>
<?php
    include("db/config.php");
    
    include("include/head.php");
?>
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
                        Others Seminars
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li class="active">Others</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <p>
                <a href="othersCreate.php" class="btn btn-success"><i class="fa fa-plus"></i> Apply for other seminar</a>
            </p>
                
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Title</th>
                                    <th class="active">Category</th>
                                    <th class="active">Venue</th>
                                    <th class="active">Request</th>
                                    <th class="active">Date</th>
                                    <!-- <th class="active">Days Left</th> -->
                                </tr>
                            </thead>
                            <tbody class="hoverRow">
                                <!-- <tr class="viewRow" data-toggle="modal" data-target="#sem1">
                                    <td>PSITE National Conference (NATCON)</td>
                                    <td>Research</td>
                                    <td>Region IV</td>
                                    <td>
                                        <button class="btn btn-warning">Waiting for feedback <i class="fa fa-sign-out"></i></button>
                                    </td>
                                    <td>Done</td>
                                    <td>2 weeks left</td>
                                </tr> -->

                                <?php
                                $conn = mysqli_connect("localhost","root","","efs");
                                    $q = mysqli_query($conn, "
                                        SELECT * FROM `sem_emp` 
                                        INNER JOIN othersem 
                                        ON sem_emp.sem_id = othersem.otherSem_id 
                                        WHERE sem_emp.email = '$email' 
                                        AND othersem.academicyear='".$_SESSION['academicyear']."' 
                                        ");
                                    if(mysqli_num_rows($q)!=0){
                                        while($rows = mysqli_fetch_assoc($q))
                                        {
                                            $email = $rows['email'];
                                            $title = $rows['title'];
                                            $cat = $rows['category'];
                                            $venue = $rows['venue'];
                                            $date = date('M d, Y', strtotime($rows['dates']));
                                            echo "
                                            <tr>
                                                <td>$title</td>
                                                <td>$cat</td>
                                                <td>$venue</td>
                                                <td><button class='btn btn-warning'>Waiting for feedback <i class='fa fa-sign-out'></i></button></td>
                                                <td>$date</td>
                                            <tr>
                                            ";
                                        }
                                    }else{
                                        echo "No records found in the database";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Seminar Modal -->
    <div class="modal fade" id="sem1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <p class="col-sm-5">
                                        <strong>Title: </strong>
                                    </p>
                                    <p class="col-sm-7">
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
                                    <p class="col-sm-5">
                                        <strong>Sponsoring Org: </strong>
                                    </p>
                                    <p class="col-sm-7">
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
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Documents and Reasons</div>
                                <div class="panel-body">
                                  <div class="col-sm-6">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Invitation/Supporting Documents: </label>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <u class="text-primary">
                                                        sample-invitation.jpg
                                                    </u>
                                                </li>
                                                <li class="list-group-item">
                                                    <u class="text-primary">
                                                        random-docs.docx
                                                    </u>
                                                </li>
                                                <li class="list-group-item">
                                                    <u class="text-primary">
                                                        sample-invitation(random).png
                                                    </u>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                  </div>
                                  <div class="col-sm-6">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Reasons for Attending: </label>
                                            <p>
                                                A random excuse to fill this form slightly. Feel free to add more.
                                            </p>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-7">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Persons Involved</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>8</strong> persons will be joining this seminar including: <strong>Heads,Faculty and Staffs</strong></p>
                                        <div class="list-group">
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
                                        <div class="panel-heading">Budget</div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 text-center">
                                                <strong>Total Budget Requirement</strong>
                                                <h4>&#8369;15, 100.00</h4>
                                            </div>
                                            <div class="col-sm-12 text-center">
                                            <hr>
                                                <strong>Your Budget</strong>
                                                <h4>&#8369;800.00</h4>
                                            </div>
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
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Seminar Modal -->
    <div class="modal fade" id="applySem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="padding-top: 10%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Apply for a seminar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4>What kind of seminar are you applying for?</h4>
                            <div class="col-sm-4">
                                <a href="seminarCreateOff.php" class="btn btn-success btn-lg">
                                <i class="fa fa-building-o"></i>
                                 Off-Campus
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <h4><i class="fa fa-long-arrow-left"></i> OR <i class="fa fa-long-arrow-right"></i></h4>
                            </div>
                            <div class="col-sm-4">
                                <a href="seminarCreateIn.php" class="btn btn-primary btn-lg">
                                <i class="fa fa-home"></i>
                                 In-House
                                </a>
                            </div>
                        </div>
                    </div>
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
