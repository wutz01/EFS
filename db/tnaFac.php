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

                        Training Needs Monitoring

                    </h1>

                    <ol class="breadcrumb">

                        <li>

                            <a href="">

                                <i class="fa fa-book"></i> Manage

                            </a>

                        </li>

                        <li class="active">Training Needs Monitoring</li>

                    </ol>

                </div>

            </div>

            <!-- /.row -->



            <div class="row">

                <div class="col-sm-12">

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="table-responsive">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr class="active">

                                            <th>Academic Year</th>

                                            <th>Date Created</th>

                                            <th>Status</th>

                                             <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody class="hoverRow">

                                    <?php

                                         $result = mysql_query("SELECT * FROM tnalist where email='$email' order by id DESC");

                                        while($row = mysql_fetch_array($result)){

                                            echo '<tr class="viewRow" >';

                                                echo '<td>';

                                                echo $row['academicyear'];

                                                echo '</td>';

                                                echo '<td>';

                                                echo $row['date_created'];

                                                echo '</td>';

                                                echo '<td>';



                                                $faculty_note=$row["faculty_note"];

                                                $dean_note=$row["dean_note"];



                                                if(($faculty_note=="New")&&($dean_note=="New")){

                                                    echo '<button class="btn btn-warning">Waiting for your Approval <i class="fa fa-check-circle"></i></button>';

                                                }else if(($faculty_note=="Revision")&&($dean_note=="New")){

                                                    echo '<button class="btn btn-success">Feedback Sent <i class="fa fa-check-circle"></i></button>';

                                                }else if(($faculty_note=="Approved")&&($dean_note=="New")){

                                                    echo '<button class="btn btn-primary">Waiting for Dean';

                                                    echo 's Approval <i class="fa fa-check-circle"></i></button>';

                                                }else if(($faculty_note=="Approved")&&($dean_note=="Approved")){

                                                    echo '<button class="btn btn-primary">Approved by Dean';

                                                    echo ' <i class="fa fa-check-circle"></i></button>';

                                                }



                                                // echo '    <!-- <button class="btn btn-warning">Waiting for feedback <i class="fa fa-sign-out"></i></button> -->

                                                

                                                echo '</td>';

                                                echo '<td>';

                                                $faculty_note=$row["faculty_note"];

                                                $dean_note=$row["dean_note"];



                                                if(($faculty_note=="New")&&($dean_note=="New")){

                                                    echo '<form action="db/db_viewNewTna.php" method="post" class="form" role="form" enctype="multipart/form-data">';

                                                    echo '<input type="text" style="width:1px;visibility:hidden;" name="tnaid" value="';

                                                    echo $row['id'];

                                                    echo '">';

                                                    echo '<button class="btn btn-success">View <i class="fa fa-eye"></i></button>';

                                                    echo '</form>';

                                                }else if(($faculty_note=="Revision")&&($dean_note=="New")){

                                                    echo '<button class="btn btn-warning">Closed <i class="fa fa-ban"></i></button>';

                                                }else if(($faculty_note=="Approved")&&($dean_note=="New")){

                                                     echo '<button class="btn btn-warning">Closed <i class="fa fa-ban"></i></button>';

                                              }else if(($faculty_note=="Approved")&&($dean_note=="Approved")){

                                                   echo '<form action="tnaView.php" method="post" class="form" role="form" enctype="multipart/form-data">';

                                                    echo '<input type="text" style="width:1px;visibility:hidden;" name="tnaid" value="';

                                                    echo $row['id'];

                                                    echo '">';

                                                   echo '<button class="btn btn-success">View <i class="fa fa-eye"></i></button>';

                                                    echo '</form>';  

                                                }

                                                echo '</td>';

                                            echo '</tr>';

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



    <?php

        include('include/foot.php');

    ?>



</body>



</html>