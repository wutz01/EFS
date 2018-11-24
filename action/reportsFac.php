<!DOCTYPE html>
<html lang="en">

<title></title>
<?php
    include("action/session-auth.php");
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
                            Reports
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-pie-chart"></i> Reports
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h2>Job Roles Summary</h2>
                                            <p class="text-muted">View summary of your <strong class="text-primary">Job Role Competencies.</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="pdf/reports.php?type=tna&email=<?php echo $email; ?>" target="_blank" class="text-muted">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Report</span>
                                        <span class="pull-right text-primary">
                                            <i class="fa fa-arrow-circle-right fa-2x"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h2>Training Needs Analysis</h2>
                                            <p class="text-muted">View your <strong class="text-primary">TNA</strong> created by your CHAIR.</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="pdf/reports.php?type=tnaFac&email=<?php echo $email; ?>" target="_blank" class="text-muted">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Report</span>
                                        <span class="pull-right text-primary">
                                            <i class="fa fa-arrow-circle-right fa-2x"></i>
                                        </span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
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
