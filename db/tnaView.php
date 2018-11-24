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
    $id=$_POST['tnaid'];
    $result = mysql_query("SELECT * FROM tnalist where id='$id' order by id DESC");
    while($row = mysql_fetch_array($result)){
        $academicyear =$row['academicyear'];
        $email = $row['email'];
        $datecreated = $row['date_created'];
            $result1 = mysql_query("SELECT * FROM profile where email='$email'");
            $row1 = mysql_fetch_array($result1);
            $lastname = $row1['lastname'];
            $firstname = $row1['firstname'];
            $position = $row1['designation'];
            $department = $row1['college'];
           
        
    }


?>

        <div id="page-wrapper">

            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Training Needs Monitoring
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li>
                            <a href="tna2.php">
                                Training Needs Monitoring
                            </a>
                        </li>
                        <li class="active">Academic Year <?php
                        echo $academicyear;
                        ?></li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-header">Academic Year <?php
                        echo $academicyear;
                        ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <p class="col-sm-3">
                                    <strong>Faculty: </strong>
                                </p>
                                <p class="col-sm-9">
                                    <?php
                                        echo $firstname." ".$lastname;
                                    ?> 
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <p class="col-sm-3">
                                    <strong>Date Created: </strong>
                                </p>
                                <p class="col-sm-9">
                                    Dec 23,2016 07:47pm 
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <p class="col-sm-3">
                                    <strong>Position: </strong>
                                </p>
                                <p class="col-sm-9">
                                    <?php
                                        echo strtoupper($position);
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <p class="col-sm-3">
                                    <strong>Department: </strong>
                                </p>
                                <p class="col-sm-9">
                                    <?php
                                        echo strtoupper($department);
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-sm-3 active">Job Role Competencies</th>
                                    <th class="col-sm-1 active">Position</th>
                                    <th class="col-sm-1 active">Person</th>
                                    <th class="col-sm-1 active">Competency</th>
                                    <th class="col-sm-3 active">Development Plan</th>
                                    <th class="col-sm-2 active">Post-Activity Documents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo $academicyear;
                                     $result = mysql_query("SELECT * FROM tna where email='$email' and annualyear='$academicyear'");
                                         while($row = mysql_fetch_array($result)){

                                            $docs = explode(";", $row['evidence']);

                                             echo '<tr>';
                                                echo '<td>';
                                                  echo $row["job_role"];  
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["position_importance"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["ability"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["competency"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["developmentplan"];
                                                echo '</td>';

                                                echo '<td>';

                                                foreach($docs as $doc){
                                                    echo '<a href="uploads/'.$doc.'" target="_blank">'.$doc.'</a><br>';
                                                }

                                                echo '</td>';
                                            echo '</tr>';
                                         }

                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                
                   
                           <div class="col-sm-12">
                            <div id="data"></div>
                            <form id="uploadForm" action="action/uploadTNA.php" method="post">
                                <input name="email" type="hidden" class="form-control" value="<?php echo $email; ?>" />
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Job Role</label>
                                        <select name="jobrole" class="form-control">
                                        
                                          <?php

                                        $q = mysql_query("SELECT * FROM tna WHERE email='$email' AND annualyear='$academicyear' ");
                                            while($rows=mysql_fetch_assoc($q)){
                                                $job_id = $rows['id'];
                                                $job_role = $rows['job_role'];

                                                echo "<option value='$job_id'>$job_role</option>";
                                            }
                                      ?>
                                      </select>
                                   </div>
                               </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Upload: </label><br/>
                                        <input name="docs[]" type="file" class="form-control" multiple />
                                    </div>
                              </div>

                                <div class="form-group">
                                   <input type="submit" value="Submit" class="btn btn-primary btnSubmit" />
                               </div>
                            </form>
                       </div>
                       
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label>Remarks: </label>
                                <textarea cols="30" rows="10" id="remarks" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                        <br>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Status</h3>
                                </div>
                                <div class="panel-body text-center">
                                    <button class="btn btn-warning">Waiting for feedback <i class="fa fa-sign-out"></i></button>
                                    <!-- <h6 class="small text-muted"><i class="fa fa-check"></i> Seen 11:34pm</h6> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- This will be removed once the HR approved TNA -->
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8 text-right">
                            <a class="btn btn-primary btn-lg" onClick="writeRemarks()" data-toggle="modal" data-target="#reviewTNA">
                            Submit
                             <i class="fa fa-send-o"></i>
                            </a>
                        </div>
                    </div>

                    <!-- This will show up once the HR approved TNA -->
                    <!-- <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-header">Something</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="active">
                                            <th class="col-sm-6">Job Role Competencies</th>
                                            <th class="col-sm-6">Something</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Classroom Management
                                            </td>
                                            <td>
                                                <!-- <button class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                Upload
                                                </button> -->
                                               <!--  <input type="file" class="form-control" multiple>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Organization and Delivery of Instruction
                                            </td>
                                            <td>
                                                <button class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                Upload
                                                </button>
                                                <input type="file" class="form-control" multiple>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Outcomes-Based Education
                                            </td>
                                            <td> -->
                                                <!-- <button class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                Upload
                                                </button> -->
                                                <!-- <input type="file" class="form-control" multiple>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Teaching Strategies
                                            </td>
                                            <td>
                                                <button class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                Upload
                                                </button>
                                                <input type="file" class="form-control" multiple>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --> 

                </div>
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="reviewTNA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">TNA</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Faculty: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                         <?php
                                        echo $firstname." ".$lastname;
                                    ?> 
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>Date Created: </strong>
                                    </p>
                                    <p class="col-sm-8">
                                        <?php
                                        echo $datecreated;
                                    ?> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Position: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                         <?php
                                        echo strtoupper($position);
                                    ?> 
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>Department: </strong>
                                    </p>
                                    <p class="col-sm-8">
                                         <?php
                                        echo strtoupper($department);
                                    ?> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-sm-4 active">Job Role Competencies</th>
                                        <th class="col-sm-1 active">Position</th>
                                        <th class="col-sm-1 active">Person</th>
                                        <th class="col-sm-1 active">Competency</th>
                                        <th class="col-sm-4 active">Development Plan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                     $result = mysql_query("SELECT * FROM tna where email='$email' and annualyear='$academicyear'");
                                         while($row = mysql_fetch_array($result)){
                                             echo '<tr>';
                                                echo '<td>';
                                                  echo $row["job_role"];  
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["position_importance"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["ability"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["competency"];
                                                echo '</td>';
                                                echo '<td>';
                                                    echo $row["developmentplan"];
                                                echo '</td>';
                                            echo '</tr>';

                                         }
                                ?>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                    
                                    <label>Remarks: </label>
                                    <textarea cols="30" rows="10" class="form-control" id="confirmremarks" name="confirmremarks" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                            <br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Status</h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <button class="btn btn-warning">For feedback <i class="fa fa-sign-out"></i></button>
                                        <!-- <h6 class="small text-muted text-center"><i class="fa fa-check"></i> 11:34pm</h6> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <div  class="row">
                             <div class="col-sm-6">
                                
                            </div>  
                            <div class="col-sm-2">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>  
                             <div class="col-sm-2">
                             <form action="db/db_returnTna.php" method="post" class="form" role="form" enctype="multipart/form-data">
                                    <input type="text" name="returns" id="returns" style="width:1px;visibility:hidden;">
                                    <button type="submit" class="btn btn-warning">Return</button>
                                </form>
                            </div>  
                             <div class="col-sm-2">
                                 <form action="db/db_confirmTna.php" method="post" class="form" role="form" enctype="multipart/form-data">
                                    <input type="text" name="confirms" id="confirms" style="width:1px;visibility:hidden;">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
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

    <script>
        $(function(){

            function writeRemarks(){
                var rem = document.getElementById('remarks').value;
                document.getElementById('confirmremarks').value=rem;
                document.getElementById('returns').value=rem;
                 document.getElementById('confirms').value=rem;
            }

            $("#uploadForm").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "action/uploadTNA.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        // $("#data").html(data);
                        alert("Success");
                        location.reload();
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