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

                        Seminars

                    </h1>

                    <ol class="breadcrumb">

                        <li>

                            <a href="">

                                <i class="fa fa-book"></i> Manage

                            </a>

                        </li>

                        <li class="active">Seminars

                        </li>

                    </ol>

                </div>

            </div>

            <!-- /.row -->

            
    


            <p>

                <a data-toggle="modal" data-target="#applySem" class="btn btn-success"><i class="fa fa-plus"></i> Apply for a seminar</a>

            </p>

                

            <div class="row">
                <div class="col-sm-12">



                    <div class="panel panel-default">

                    <div class="panel-heading">Seminar/Training Applications for Approval</div>

                        <div class="panel-body">

                            <ul class="nav nav-pills">

                                <li class="active"><a href="#offCamp" data-toggle="tab">Off-Campus</a></li>

                                <li><a href="#inHouse" data-toggle="tab">In House</a></li>

                            </ul>

                            <br>

                            <div class="tab-content">

                            <input type="hidden" id="position" value="<?php echo $logUser; ?>">

                                <div class="tab-pane fade in active" id="offCamp">

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="table-responsive">

                                                <table class="table table-bordered">

                                                    <thead>

                                                        <tr>

                                                            <th class="active col-sm-2">Title</th>

                                                            <th class="active col-sm-1">Category</th>

                                                            <th class="active col-sm-2">Venue</th>

                                                            <th class="active col-sm-2">Email</th>
                                                            <th class="active col-sm-3">Request</th>

                                                            <!-- <th class="active col-sm-2">Action</th> -->

                                                        </tr>

                                                    </thead>

                                                    <tbody class="hoverRow">

                                                     <?php

                                                        if($logUser=="faculty"){
                                                           $filterCollege = "AND mustattend.department = '$college'";
                                                        }else if($logUser=="dean"){
                                                           $filterCollege = "AND mustattend.department = '$college'";
                                                        }else{
                                                           $filterCollege = "";
                                                        }


$conn = mysqli_connect("localhost","root","","efs");
                                $departments = $college;
                                                         $result = mysqli_query($conn, "

                                                            SELECT sem_emp.sem_id AS req_id, sem_emp.chair_status AS chair_stat, sem_emp.dean_status AS dean_stat, sem_emp.vpar_status AS vpar_stat, sem_emp.hr_status AS hr_stat, sem_emp.md_status AS md_stat, sem_emp.email, mustattend.title, mustattend.category, mustattend.venue, mustattend.dates FROM sem_emp INNER JOIN mustattend ON sem_emp.sem_id = mustattend.mas_id WHERE email !='$email' $filterCollege ORDER BY sem_emp.sem_id DESC");

                                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                                                            $chair_stat = $row['chair_stat'];
                                                            $dean_stat = $row['dean_stat'];
                                                            $vpar_stat = $row['vpar_stat'];
                                                            $hr_stat = $row['hr_stat'];
                                                            $md_stat = $row['md_stat'];
                                                            $reqEmail = $row['email'];
                                                            $reqid = $row['req_id'];
                                                            $dates = $row['dates'];

                                                            $title = $row['title'];
                                                            $category = $row['category'];
                                                            $venue = $row['venue'];

                                                            $thisGetPos = mysqli_query($conn, "SELECT user_account.usertype_id FROM user_account WHERE user_account.email = '$reqEmail' ");
                                                            while($row = mysqli_fetch_array($thisGetPos)){
                                                                $thisPos = $row['usertype_id'];
                                                            }

                                                            $thisGetPos = mysqli_query($conn, "SELECT user_account.usertype_id FROM user_account WHERE user_account.email = '$reqEmail' ");
                                                            while($row = mysqli_fetch_array($thisGetPos, MYSQLI_ASSOC)){
                                                                $thisPos = $row['usertype_id'];
                                                            }

                                                            

                                                            if($logUser=="chair"){
                                                                if($thisPos=="faculty"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }
                                                            }else if($logUser=="dean"){
                                                                if($thisPos=="chair"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="faculty"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                    //show
                                                                }
                                                            }else if($logUser=="vpar"){
                                                                if($thisPos=="dean"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="chair"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="faculty"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                    //show
                                                                }
                                                            }else if($logUser=="hr"){
                                                                if($thisPos=="vpar"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                    //show
                                                                }else if($thisPos=="dean"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="chair"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="faculty"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }
                                                            }else if($logUser=="md"){
                                                                if($thisPos=="hr"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="vpar"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="dean"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="chair"){
                                                                    //show
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                }else if($thisPos=="faculty"){
                                                                    showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser);
                                                                    //show
                                                                }
                                                            }

                                                        }

                                                        function showRow($reqid,$title,$category,$venue,$dates,$reqEmail,$chair_stat,$dean_stat,$vpar_stat,$hr_stat,$md_stat,$logUser){
                                                                echo '<tr data-toggle="modal" data-target="#modalSem" class="viewRow reqRow checkRow" data-id='.$reqid.'>';

                                                                echo '<td>';

                                                                echo $title;

                                                                echo '</td>';

                                                                echo '<td>';

                                                                echo $category;

                                                                echo '</td>';

                                                                echo '<td>';

                                                                echo $venue;

                                                                echo '</td>';

                                                                echo "<td>".$reqEmail."</td>";

                                                                echo '<td>';
                                                                $approve = "chair";
                                                                if($chair_stat==1){
                                                                    $approve = "dean";
                                                                    if($dean_stat==1){
                                                                        $approve = "vpar";
                                                                        if($vpar_stat==1){
                                                                            $approve = "hr";
                                                                            if($hr_stat==1){
                                                                                $approve = "md";
                                                                                if($md_stat==1){
                                                                                    $approve = "approve";
                                                                                    echo '<div class="status status-success">Application Approved. <i class="fa fa-check"></i></div>';
                                                                                }else{
                                                                                    echo '<div class="status status-warning">Waiting for MD\'s approval <i class="fa fa-sign-out"></div>';
                                                                                }       
                                                                            }else{
                                                                                echo '<div class="status status-warning">Waiting for HR\'s Verification <i class="fa fa-sign-out"></div>';
                                                                            }
                                                                        }else{
                                                                            echo '<div class="status status-warning">Waiting for VPAR\'s approval <i class="fa fa-sign-out"></div>';
                                                                        }
                                                                    }else{
                                                                        echo '<div class="status status-warning">Waiting for Dean\'s approval <i class="fa fa-sign-out"></div>';
                                                                    }
                                                                }else{
                                                                    echo '<div class="status status-warning">Waiting for Chair\'s approval <i class="fa fa-sign-out"></div>';
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

                                <div class="tab-pane fade" id="inHouse">

                                    

                                </div>

                            </div>



                        </div>

                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="panel panel-default">

                    <div class="panel-heading">Your Seminar/Training Applications</div>

                        <div class="panel-body">

                            <ul class="nav nav-pills">

                                <li class="active"><a href="#offCamp" data-toggle="tab">Off-Campus</a></li>

                                <li><a href="#inHouse" data-toggle="tab">In House</a></li>

                            </ul>

                            <br>

                            <div class="tab-content">

                                <div class="tab-pane fade in active" id="offCamp">

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="table-responsive">

                                                <table class="table table-bordered">

                                                    <thead>

                                                        <tr>

                                                            <th class="active">Title</th>

                                                            <th class="active">Category</th>

                                                            <th class="active">Venue</th>

                                                            <th class="active">Request</th>

                                                            <th class="active">Days Left</th>
                                                            <th class="active"></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody class="hoverRow">

                                                     <?php

                                                        if($logUser=="faculty"){
                                                           $filterCollege = "AND mustattend.department = '$college'";
                                                        }else if($logUser=="dean"){
                                                           $filterCollege = "AND mustattend.department = '$college'";
                                                        }else{
                                                           $filterCollege = "";
                                                        }

$conn = mysqli_connect('localhost', 'root', '', 'efs');

                                                         $result = mysqli_query($conn, "

                                                            SELECT 
                                                            sem_emp.id AS req_id,
                                                            sem_emp.sem_id AS sem_id,
                                                            sem_emp.chair_status AS chair_stat,
                                                            sem_emp.dean_status AS dean_stat,
                                                            sem_emp.vpar_status AS vpar_stat,
                                                            sem_emp.hr_status AS hr_stat,
                                                            sem_emp.md_status AS md_stat,
                                                            sem_emp.email, mustattend.title,
                                                            mustattend.category, mustattend.venue, mustattend.dates

                                                            FROM sem_emp
                                                            INNER JOIN mustattend
                                                            ON sem_emp.sem_id = mustattend.mas_id
                                                            WHERE email ='$email'
                                                            $filterCollege
                                                            ORDER BY sem_emp.id DESC

                                                            ");

                                                          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){


                                                            $chair_stat = $row['chair_stat'];
                                                            $dean_stat = $row['dean_stat'];
                                                            $vpar_stat = $row['vpar_stat'];
                                                            $hr_stat = $row['hr_stat'];
                                                            $md_stat = $row['md_stat'];
                                                            $reqEmail = $row['email'];
                                                            $reqid = $row['req_id'];
                                                            $masid = $row['sem_id'];
                                                            $dates = $row['dates'];

                                                            $title = $row['title'];
                                                            $category = $row['category'];
                                                            $venue = $row['venue'];

                                                            if(date("Y-m-d")>$dates){
                                                                $suffix =  "ago";
                                                            }else if(date("Y-m-d")<$dates){
                                                                $suffix = "to go";
                                                            }else{
                                                                $suffix = "TODAY!";
                                                            }


                                                            echo '<tr class="viewRow reqRow" data-id="'.$reqid.'" >';

                                                            echo '<td>';

                                                            echo $title;

                                                            echo '</td>';

                                                            echo '<td>';

                                                            echo $category;

                                                            echo '</td>';

                                                            echo '<td>';

                                                             echo $venue;

                                                            echo '</td>';

                                                            echo '<td>';
                                    $approve = "";
                                    if($chair_stat==1){
                                        $approve = "dean";
                                        if($dean_stat==1){
                                            $approve = "vpar";
                                            if($vpar_stat==1){
                                                $approve = "hr";
                                                if($hr_stat==1){
                                                    $approve = "md";
                                                    if($md_stat==1){
                                                        $approve = "approve";
                                                        echo '<div class="status status-success">Application Approved. <i class="fa fa-check"></i></div>';
                                                    }else{
                                                        echo '<div class="status status-warning">Waiting for MD\'s approval <i class="fa fa-sign-out"></div>';
                                                    }       
                                                }else{
                                                    echo '<div class="status status-warning">Waiting for HR\'s approval <i class="fa fa-sign-out"></div>';
                                                }
                                            }else{
                                                echo '<div class="status status-warning">Waiting for VPAR\'s approval <i class="fa fa-sign-out"></div>';
                                            }
                                        }else{
                                            echo '<div class="status status-warning">Waiting for Dean\'s approval <i class="fa fa-sign-out"></div>';
                                        }
                                    }else{
                                        echo '<div class="status status-warning">Waiting for Chair\'s approval <i class="fa fa-sign-out"></div>';
                                    }

                                                            echo '</td>';
                                                            echo '<td>';
                                
                                                        echo $chronoDate = chrono(date("Y-m-d"),$dates)." ".$suffix;
                                                        echo '</td>';

                                                        echo '
                                                        <td>
                                                        <a href="viewSeminar.php?reqid='.$reqid.'" class="btn btn-primary">View <i class="fa fa-search fa-fx"></i></a>
                                                        </td>
                                                        ';

                                                        echo '</tr>';

                                                          }


                                          function chrono($date1,$date2){
                                                $date1 = new DateTime($date1); //$datetime1 is usually the current date
                                                $date2 = new DateTime($date2);

                                                $diff=date_diff($date1, $date2);
                                                $timemsg="";

                                                $years = $diff->y;
                                                $months = $diff->m;
                                                $days = $diff->d;

                                                if($years > 0){
                                                    if($years <= 1){
                                                      $timemsg = $years .' year'. ($years > 1?"s":'');
                                                    }
                                                }
                                                else if($months > 0){
                                                 $timemsg = $months . ' month'. ($months > 1?"s":'');
                                                }
                                                else if($days > 0){
                                                    if($days == 0){
                                                      $timemsg = "Yesterday";
                                                    }else{
                                                      $timemsg = $days .' day'. ($days > 1?"s":'');
                                                    }
                                                }
                                                // else if($diff->h > 0){
                                                //     $timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
                                                // }
                                                // else if($diff->i > 0){
                                                //  $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
                                                // }
                                                // else if($diff->s > 0){
                                                //  $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
                                                // }

                                                return $timemsg;
                                            }
                                                        ?>

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>



                                </div>

                                <div class="tab-pane fade" id="inHouse">

                                    

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

    <!-- Seminar Modal -->

    <div class="modal fade" id="applySem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" style="padding-top: 10%">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title" id="myModalLabel">Apply for a seminar</h4>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">

                            <h4>What kind of seminar are you applying for?</h4>

                            <div class="col-sm-4">

                                <a href="seminarCreateOff.php" class="btn btn-success btn-lg">

                                <i class="fa fa-building-o"></i>

                                 Off-Campus

                                </a>

                            </div>

                            <div class="col-sm-4">

                                <h4><i class="fa fa-long-arrow-left"></i> OR <i class="fa fa-long-arrow-right"></i></h4>

                            </div>

                            <div class="col-sm-4">

                                <a href="seminarCreateIn.php" class="btn btn-primary btn-lg">

                                <i class="fa fa-home"></i>

                                 In-House

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->


    <!-- VIEW SEMINAR -->
    <div class="modal fade" id="modalSem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" style="padding-top: 10%">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title" id="myModalLabel">Apply for a seminar</h4>

                </div>

                <div class="modal-body">
                    <div id="dataModal"></div>

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

            var selected_reqid = '';

            $(document).on('click','#btn-approve', function(){
                var reqid = selected_reqid;
                console.log(reqid);
                
                // var reqid = $(this).closest('.reqRow').data('id');
                var position = $("#position").val();
                $.get("action/approve.php",{
                    action: "approve_seminar",
                    reqid: reqid,
                    position: position
                }, function(data){
                    if(data=="ok"){
                        alert("Approved Success!");
                        location.reload();
                    }else{
                        console.log(data);
                    }
                });
            });

            $(".checkRow").click(function(){
                $("#dataModal").html("Loading...");
                var reqid = $(this).data("id");

                selected_reqid = reqid;
                // alert(reqid);

                $.get("action/get.php",{
                    action: "sem_emp",
                    reqid: reqid,
                    loguser: $("#position").val()
                },function(data){
                    $("#dataModal").html(data);
                    // console.log(data);
                });
            });

        });
    </script>



</body>



</html>

