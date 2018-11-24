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
                        Travel Policy
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-cog"></i> Maintenance
                            </a>
                        </li>
                        <li class="active">Travel Policy</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div id="msg"></div>
                <div class="col-sm-6">
                <h3 class="page-header">
                    Hotel Accommodation
                </h3>
                <form class="form-horizontal">
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'efs');
                    $q = mysqli_query($conn, "SELECT * FROM travel_guide WHERE fee_type = 'hotel' ");
                    while($rows=mysqli_fetch_assoc($q)){
                        $que = mysqli_query($conn, "SELECT user FROM user_types
                            inner join travel_guide
                            on user_types.id = travel_guide.user_type
                            ");
                        while($row = mysqli_fetch_assoc($que))
                        {
                            $pos = $row['user'];
                        }
                        
                        echo '
                        <div class="col-sm-12">
                           <div class="form-group">
                             <label class="col-sm-2 control-label">'.ucwords($pos).'</label>
                             <div class="col-sm-10">
                               <input type="email" class="form-control" id="'.$pos.'Hotel" value="'.$rows['amount'].'">
                             </div>
                           </div>
                        </div>
                        ';   
                    }

                ?>
                </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                <h3 class="page-header">
                    Per Diem
                </h3>
                <form class="form-horizontal">
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'efs');
                    $q = mysqli_query($conn, "SELECT * FROM travel_guide WHERE fee_type = 'diem' ");
                    while($rows=mysqli_fetch_assoc($q)){
                        $que = mysqli_query($conn, "SELECT user FROM user_types
                            inner join travel_guide
                            on user_types.id = travel_guide.user_type
                            ");
                        while($row = mysqli_fetch_assoc($que))
                        {
                            $pos = $row['user'];
                        }
                        
                        echo '
                        <div class="col-sm-12">
                           <div class="form-group">
                             <label class="col-sm-2 control-label">'.ucwords($pos).'</label>
                             <div class="col-sm-10">
                               <input type="email" class="form-control" id="'.$pos.'Diem" value="'.$rows['amount'].'">
                             </div>
                           </div>
                        </div>
                        ';   
                    }

                ?>
                </form>
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

    <?php
            include('include/foot.php');
    ?>

    <script>
    $(function(){
        $("#btnSubmit").click(function(){
            var deanHotel = $("#deanHotel").val();
            var chairHotel = $("#chairHotel").val();
            var facultyHotel = $("#facultyHotel").val();
            var deanDiem = $("#deanDiem").val();
            var chairDiem = $("#chairDiem").val();
            var facultyDiem = $("#facultyDiem").val();

            $.get("action/save.php",{
                action: "maintenance_change_travel",
                value: {
                    deanHotel: deanHotel,
                    chairHotel: chairHotel,
                    facultyHotel: facultyHotel,
                    deanDiem: deanDiem,
                    chairDiem: chairDiem,
                    facultyDiem: facultyDiem
                }
            },function(response){
                $("#msg").html(response);
            });
        });
    });
    </script>

</body>

</html>
