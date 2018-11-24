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
                        Employee <small>Create New</small><input type="text" id="useremail" value="<?php
                        echo $email;
                        ?>" style="visibility:hidden;">
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="employee.php">
                                <i class="fa fa-user"></i> Employee
                            </a>
                        </li>
                        <li class="active">Create New</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                              <input type="email" class="form-control" id="emp-email" value="" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Date Created</label>
                            <input type="text" class="form-control" id="emp-dateCreated" value="<?php echo date('M d,Y h:ia'); ?>" readonly>
                        </div>
                    </div>
                     
                    

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="emp-fname" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text" class="form-control" id="emp-mname">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="emp-lname" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Position</label>
                            <select id="emp-pos" class="form-control" required>
                                <option>Dean</option>
                                <option>Chair</option>
                                <option>Faculty</option>
                                <option>Staff</option>
                                <option>HR</option>
                                <option>VPAR</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>School</label>
                            <select id="emp-school" class="form-control" required>
                               <?php
                               $conn = mysqli_connect('localhost', 'root', '', 'efs');
                               $s = mysqli_query($conn, "SELECT * FROM faith_school");
                                   while($rows=mysqli_fetch_assoc($s)){
                                        $school_id = $rows['id'];
                                        $school = $rows['school'];

                                        echo "<option value='$school_id'>$school</option>";
                                   }
                               ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select id="emp-dept" class="form-control" required>
                               <?php
                               $conn = mysqli_connect('localhost', 'root', '', 'efs');
                               $qwqwq = mysqli_query($conn, "SELECT * FROM faith_department");
                                   while($rows=mysqli_fetch_assoc($qwqwq)){
                                        $dept_id = $rows['id'];
                                        $dept = $rows['abbr'];
                                        echo "<option value='$dept_id'>$dept</option>";
                                   }
                               ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 pull-right text-right">
                            <div class="checkbox">
                                <label>
                                    <!-- <input type="checkbox" value="">Send to this faculty automatically -->
                                </label>
                            </div>
                            <a data-toggle="modal" data-target="#revEmp" id="btnEmpRev" class="btn btn-primary btn-lg">
                            Submit 
                            <i class="fa fa-send"></i>
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
    
    <div class="modal fade" id="revEmp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Employee</h4>
                </div>
                <div class="modal-body">
                    <h1>REVIEW</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSubmit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <?php
            include('include/foot.php');
    ?>

    <script>
    $(document).ready(function(){
        $("#emp-school").change(function(){
            var school_id = $(this).val();
            $.get("action/get.php", { action: 'department',value: school_id }, function(data){
                $("#emp-dept").empty();
                $.each(data, function(key, val){
                    $("#emp-dept").append('\
                        <option value="'+data[key].id+'">'+data[key].department+'</option>\
                        ');
                });
            });
        });

        $("#btnSubmit").click(function(){
            var email = $("#emp-email").val();
            var date = $("#emp-dateCreated").val();
            var fname = $("#emp-fname").val();
            var mname = $("#emp-mname").val();
            var lname = $("#emp-lname").val();
            var pos = $("#emp-pos").val();
            var dept = $("#emp-dept").val();

            var data = {
                email: email,
                fname: fname,
                mname: mname,
                lname: lname,
                pos: pos,
                dept: dept
            }

            $.get("action/add.php", { 
                action: 'employee',
                value: data 
            }, function(data){
                console.log(data);
                alert("EMPLOYEE ADDED!");
                location.reload();
            });
        });
    });
    </script>

</body>

</html>
