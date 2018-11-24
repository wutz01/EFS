        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding: 10px 15px;">
                    <img src="img/efsdp_logo_mini.png" class="img-responsive" alt="" style="width:32px;height:32px">
                </a>
                <a class="navbar-brand" href="index.php">
                    Faculty And Staff Development Program
                </a>
            </div>

            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                <?php

                $host = 'localhost';
                $serverUsername = 'root';
                $serverPassword = '';
                $database = 'efs';

                $conn = mysqli_connect($host, $serverUsername, $serverPassword, $database);

                    $usertype = $_SESSION['user'];
                    $dept = $_SESSION['college'];
                    $user_email = $_SESSION['username'];

                    if($usertype =="chair"){
                        $filterCollege = "AND college = '$dept'";
                    }
                    else if($usertype =="dean"){
                        $filterCollege = "AND college = '$dept'";
                    }
                    else if($usertype =="faculty"){
                        $filterCollege = "AND college = '$dept'";
                    }
                    else{
                        $filterCollege = "";
                    }

                    $notifStat = false;
                    $notifCount = mysqli_query($conn,"SELECT * FROM user_notification WHERE user_to = '$usertype' $filterCollege ORDER BY date_created DESC");
                    $unreadCount = mysqli_query($conn,"SELECT * FROM user_notification WHERE user_to = '$usertype' $filterCollege AND has_read = 0");

                    // $approveCount = mysqlii_query("SELECT * FROM notif WHERE type = 'seminar approved' AND user_from = '$user_email' AND has_read = 0");

                    $rowCount = mysqli_num_rows($notifCount);
                    $unreadrowCount = mysqli_num_rows($unreadCount);
                    // $approverowCount = mysqlii_num_rows($approveCount);
                    if($rowCount!=0){
                        $notifStat = true;
                    }
                    else{
                        $notifStat = false;
                    }
                ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>
                        <?php
                            if($unreadrowCount!=0){
                                echo '<span class="label label-danger" id="notifCount">';
                                echo $unreadrowCount;
                                echo '</span>';
                            }
                        ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu message-dropdown">

                    <?php
                    if($notifStat){
                        while($rows=mysqli_fetch_assoc($notifCount)){
                            $id = $rows['id'];
                            $notifType = $rows['type'];
                            $user_from = $rows['user_from'];
                            $user_to = $rows['user_to'];
                            $content = $rows['content'];
                            $has_read = $rows['has_read'];
                            $date = $rows['date_created'];
                            $link = "index.php";
                            switch ($notifType) {
                                case 'seminar':
                                    $link = "seminar.php";
                                    break;
                                case 'seminar approved':
                                    $link = "seminar.php";
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                    ?>

                    <li class="message-preview">
                        <a href="action/readNotif.php?id=<?php echo $id; ?>&link=<?php echo $link; ?>">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong><?php echo ucwords($notifType); ?></strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo date('M d,Y h:ia',strtotime($date)); ?></p>
                                    <p><?php echo $content; ?></p>
                                </div>
                            </div>
                        </a>
                    </li>

                    <?php
                        }
                    }else{
                    ?>
                    <li class="message-footer">
                        <a href="#">Empty!</a>
                    </li>
                    <?php
                    }
                    ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo ucwords(strtolower($logUser)). " " ; echo ucwords(strtolower($firstname))  ;?><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Account</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="action/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
            <?php
            include('action/ui-auth.php');
            ?>
                </ul>
            </div>
        </nav>
