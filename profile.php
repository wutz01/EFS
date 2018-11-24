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
                        Profile
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">Profile</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $conn = mysqli_connect("localhost","root","","efs");
            $q = mysqli_query($conn,"SELECT password FROM user_account WHERE email = '$email' ");
            while($rows= mysqli_fetch_array($q)){
                $password = $rows['password'];
            }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="panel-title">My Profile</div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="row col-sm-5 col-sm-offset-1">
                                    <img src="img/avatar.png" alt="" class="img-responsive">
                                </div>
                                <div class="row col-sm-6">
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" value="<?php echo "$firstname $middlename[0]. $lastname"; ?>" disabled>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" value="<?php echo strtoupper($logUser); ?>" disabled>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">College</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" value="<?php echo strtoupper($college); ?>" disabled>
                                        </div>
                                      </div>
                                      <hr>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" value="<?php echo "$email"; ?>" disabled>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#profile"><i class="fa fa-lock"></i> Change Password</a>
                                          <!-- <input type="password" class="form-control" id="password" value="<?php echo "$password"; ?>" disabled> -->
                                        </div>
                                      </div>
                                    </form>
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

    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-horizontal">
                        <div id="msg"></div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">New Password</label>
                              <div class="col-sm-8">
                                <input type="password" id="pass" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Confirm Password</label>
                              <div class="col-sm-8">
                                <input type="password" id="cpass" class="form-control">
                              </div>
                            </div>
                            <input type="hidden" id="email" value="<?php echo $email; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnSubmit" class="btn btn-primary">Submit</a>
                </div>
            </div>
        </div>
    </div>

    <?php
            include('include/foot.php');
    ?>

    <script>
        $(function(){
            $("#btnSubmit").click(function(){
                if($("#pass").val()!=$("#cpass").val()){
                    $("#msg").html('<div class="alert alert-danger"><strong><span class="fa fa-exclamation-circle"></span></strong> Password must be matched!</div>');
                }else{
                    $.get("action/save.php",{
                        action: "profile_changepass",
                        email: $("#email").val(),
                        pass: $("#pass").val()
                    },function(response){
                        if(response=="ok"){
                            alert("Password Changed");
                            location.reload();
                        }else{
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
