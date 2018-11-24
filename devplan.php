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
                        Development Plan
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-cog"></i> Maintenance
                            </a>
                        </li>
                        <li class="active">Development Plan</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <p>
                <a data-toggle="modal" data-target="#addDevPlan" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tblEmp">
                        <thead>
                            <tr class="active">
                                <th class="">#</th>
                                <th class="">Development Plan</th>
                            </tr>
                        </thead>
                        <tbody class="hoverRow">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'efs');
                            $q = mysqli_query($conn, "SELECT * FROM tna_devplan ORDER BY id");

                            if(mysqli_num_rows($q)!=0){
                                $num = 0;
                                while($rows = mysqli_fetch_assoc($q)){
                                    $num++;
                                    $devplan = $rows['description'];
                                    echo "
                                    <tr>
                                        <td>$num</td>
                                        <td>$devplan</td>
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 pull-right text-right">
                    <div class="checkbox">
                        <label>
                            <!-- <input type="checkbox" value="">Send to this faculty automatically -->
                        </label>
                    </div>
                    <a id="btnSubmit" class="btn btn-primary btn-lg">
                    Submit
                    <i class="fa fa-send"></i>
                    </a>
                </div>
            </div>
    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="addDevPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Development Plan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="action/add.php" method="get">
                                <div class="form-group">
                                    <label>Development Plan</label>
                                    <input type="text" name="value" class="form-control">
                                    <input type="hidden" name="action" value="add_devplan">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" value="Submit">
                            </form>
                </div>
            </div>
        </div>
    </div>

    <?php
            include('include/foot.php');
    ?>

</body>

</html>
