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
                        Employee
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-cog"></i> Maintenance
                            </a>
                        </li>
                        <li class="active"><i class="fa fa-user"></i> Employee</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <p>
                <a data-toggle="modal" data-target="#option" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </p>


            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tblEmp">
                                <thead>
                                    <tr class="active">
                                        <th class="">Faculty Name</th>
                                        <th class="">Email</th>
                                        <th class="">Position</th>
                                    </tr>
                                </thead>
                                <tbody class="hoverRow">
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'efs');
                                    $q = mysqli_query($conn, "
                                        SELECT * FROM user_account 
                                        INNER JOIN user_profile 
                                        ON user_account.id = user_profile.account_id 
                                        ");

                                    if(mysqli_num_rows($q)!=0){
                                        while($rows = mysqli_fetch_assoc($q)){
                                            $emp_id = $rows['id'];
                                            $email = $rows['email'];
                                            $fname = $rows['firstname'];
                                            $mname = $rows['middlename'];
                                            $lname = $rows['lastname'];
                                            $query = mysqli_query($conn, "
                                        SELECT abbr FROM faith_department 
                                        INNER JOIN user_profile 
                                        ON faith_Department.id = user_profile.dept_id 
                                        ");
                                            while($row = mysqli_fetch_assoc($query))
                                            {
                                                $college = $row['abbr'];
                                            }
                                            $designation = $rows['designation'];
                                            echo "
                                            <tr class='dataRow' data-toggle='modal' data-target='#viewEmp' data-id='$emp_id'>
                                                <td>$fname $mname[0]. $lname</td>
                                                <td>$email</td>
                                                <td>$college ".ucwords($designation)."</td>
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
                </div>
            </div>    

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    

    <div class="modal fade" id="option" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">New Employee</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4>Choose one of our option:</h4>
                            <div class="col-sm-4">
                                <a href="empCreate.php" class="btn btn-success btn-lg">
                                <i class="fa fa-user"></i>
                                 Fill a Form
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <h4><i class="fa fa-long-arrow-left"></i> OR <i class="fa fa-long-arrow-right"></i></h4>
                            </div>
                            <div class="col-sm-4">
                                <div class="span" id="import">
                                    <a class="btn btn-primary btn-lg" id="btnImport">
                                    <i class="fa fa-upload"></i>
                                     Import (CSV file)
                                    </a>
                                </div>
                                <div id="importForm">
                                    <form action="action/importEmp.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="file" name="emp" class="form-control" required>
                                        </div>
                                        <div class="input-group pull-right">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Import">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewEmp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Employee</h4>
                </div>
                <div class="modal-body">
                    <h1>VIEW EMPLOYEE <span id="emp-id"></span></h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php
        include('include/foot.php');
    ?>
    <script>
        $(function(){
            // $('#tblEmp').DataTables();
            $("#importForm").hide();
            $("#btnImport").click(function(){
                $("#importForm").show();
                $("#import").hide();
            });

            $(".dataRow").click(function(){
                var data_id = $(this).data("id");
                $("#emp-id").text(data_id);
                // alert(data_id);
            });
        });
    </script>

</body>

</html>