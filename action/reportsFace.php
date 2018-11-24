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
                                            <h2>FACE</h2>
                                            <p class="text-muted">View all must-attend seminar for <strong class="text-primary">FACE</strong> category</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="pdf/reports.php?type=masresearch&category=FACE" target="_blank" class="text-muted">
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
