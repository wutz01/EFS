<?php
include("action/session-auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>
<?php
    include("include/head.php");
    include("db/config.php");
?>

<body>

    <div id="wrapper">

<?php
    include("include/nav.php");

    $conn = mysqli_connect('localhost', 'root', '', 'efs');

    if(isset($_GET['reqid'])){
        $reqid = $_GET['reqid'];
        $q = mysqli_query($conn, "
            SELECT * FROM sem_emp 
            INNER JOIN mustattend 
            ON sem_emp.sem_id = mustattend.mas_id 
            WHERE sem_emp.id = '$reqid' 
            ");

        if(mysqli_num_rows($q)!=0){
            while($rows = mysqli_fetch_assoc($q)){
                $title = $rows['title'];
            }
        }else{
            $others = mysqli_query($conn, "
                SELECT * FROM sem_emp 
                INNER JOIN othersem 
                ON sem_emp.sem_id = othersem.otherSem_id 
                WHERE sem_emp.id = '$reqid' 
             ");
            while($rows = mysqli_fetch_assoc($others)){
                $title = $rows['title'];
                
            }
        }

    }
?>


        <div id="page-wrapper">

            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Seminars <small>View</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="seminar.php">Seminars</a></li>
                        <li class="active"><?php echo $title; ?></li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
                <div class="col-sm-12">
                    <h3 class="page-header">Seminar Details</h3>
                    <div id="data"></div>
                    <form id="uploadForm" action="action/uploadProposed.php" method="post" class="form-horizontal">
                        <input name="reqid" type="hidden" class="form-control" value="<?php echo $reqid; ?> "/>

                        <div class="form-group">
                            <label>Upload: </label><br/>
                            <input name="docs[]" type="file" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label>Actual Budget: </label><br/>
                            <input name="actual" type="text" class="form-control" />
                        </div>

                        <div class="form-group pull-right">
                            <input type="submit" value="Submit" class="btn btn-primary btnSubmit" />
                        </div>
                    </form>
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
            $("#uploadForm").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "action/uploadProposed.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        // $("#data").html(data);
                        alert("Success");
                    },
                    error: function() 
                    {
                        alert("Error");
                    }           
               });
            }));
        });
    </script>

</body>

</html>
