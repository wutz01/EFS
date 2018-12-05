<?php
    include("action/session-auth.php");
    include("include/head.php");
    include("db/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP</title>


<style>
    .badge-primary{
        background-color: #337ab7;
    }
    .badge-success{
        background-color: #449d44;
    }
    .badge-danger{
        background-color: #449d44;
    }
    .badge-default{
        background-color: #fff;
    }
    .badge-info{
        background-color: #31b0d5;
    }
    .createseminar{
      float: right;
    }
</style>

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
                            Dashboard
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <h4>Logged in as: <?php echo strtoupper($logUser); ?></h4>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Seminars this year</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                            <?php
                            $conn = mysqli_connect("localhost","root","","efs");
                            $q = mysqli_query($conn,"SELECT title, start_date, end_date FROM mustattend WHERE department = '$college' ORDER BY start_date<now() DESC");
                            if(mysqli_num_rows($q)!=0){
                                while($rows=mysqli_fetch_assoc($q)){

                                    if(date("Y-m-d")>$rows['start_date']){
                                        $suffix =  "ago";
                                        $badge = "";
                                    }else if(date("Y-m-d")<$rows['start_date']){
                                        $suffix = "to go";
                                        $badge = "badge-primary";
                                    }else{
                                        $suffix = "TODAY!";
                                        $badge = "badge-success";
                                    }
                                    $chronoDate = chrono(date("Y-m-d"),$rows['start_date']);
                                    echo '
                                    <a href="seminarCreateOff.php?title='.$rows['title'].'" class="list-group-item">
                                        <span class="badge '.$badge.'">'.$chronoDate.' '.$suffix.'</span>
                                        <i class="fa fa-fw fa-calendar"></i> '.$rows['title'].'
                                    </a>
                                    ';
                                }
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
