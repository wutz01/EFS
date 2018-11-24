<?php

switch ($logUser) {
		case 'faculty':
		facUI();
		break;

		case 'staff':
		staffUI();
		break;

		case 'chair':
		chairUI();
		break;

		case 'dean':
		deanUI();
		break;

		case 'vpar':
			# code...
		vparUI();
		break;

		case 'hr':
			# code...
		hrUI();
		break;

		case 'md':
		mdUI();
		break;

		case 'research':
		researchUI();
		break;

		case 'face':
		faceUI();
		break;
		
		default:
		header("location: ../login.php?login=failed");
		break;
	}

function authSideNav(){
	$profile = '
	<li>
	    <a href="profile.php">
	    <div class="row">
	    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
	    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
	    	</div>
	    	<div class="col-sm-12 text-center">
	    		<strong>
	    		'.$_SESSION['firstname'].' '.$_SESSION['middlename'][0].'. '.$_SESSION['lastname'].'
	    		</strong>
	    		<h5 class="text-muted"> '.$_SESSION['college'].' '.ucwords($_SESSION['user']).' </h5>
	    	</div>
	    </div>
	    </a>
	</li>
	';

	$dashboard = '
	<li>
	    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	</li>
	';

	$manage = '
	<li>
	    <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	    <ul id="manage" class="collapse">
	        <li>
	            <a href="maList.php">Must-Attend</a>
	        </li>
	        <li>
	            <a href="seminar.php">Seminar</a>
	        </li>
	        <li>
	            <a href="others.php">Others</a>
	        </li>
	    </ul>
	</li>
	';

	return $profile.''.$dashboard.''.$manage;
}

function chairUI(){
	// echo authSideNav();
	?>
			<li>
			    <a href="profile.php">
			    <div class="row">
			    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
			    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
			    	</div>
			    	<div class="col-sm-12 text-center">
			    		<strong>
			    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
			    		</strong>
			    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
			    	</div>
			    </div>
			    </a>
			</li>
			<li>
			    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
			</li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="maList.php">Must-Attend</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="reportsChair.php"><i class="fa fa-pie-chart"></i> Reports</a>
	        </li>
	    
<?php
}

function facUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsFac.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}

function staffUI(){
	?>
        <li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsFac.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}


function deanUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="maListDean.php">Must-Attend</a>
                </li>
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsDean.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}

function vparUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="maListVpar.php">Must-Attend</a>
                </li>
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsHr.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}

function hrUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo $_SESSION['firstname']." ".$_SESSION['middlename'][0].". ".$_SESSION['lastname']; ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="maListHr.php">Must-Attend</a>
                </li>
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsHr.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#maintenance"><i class="fa fa-fw fa-cog"></i> Maintenance <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="maintenance" class="collapse">
                <li>
                    <a href="employee.php">Employee</a>
                </li>
                <li>
                    <a href="travel.php">Travel Policy</a>
                </li>
                <!--<li>
                    <a href="jobroles.php">Job Role Competency</a>
                </li>-->
                <li>
                    <a href="devplan.php">Development Plan</a>
                </li>
                <li>
                    <a href="category.php">Category</a>
                </li>
                <li>
                    <a href="department.php">Department</a>
                </li>
            </ul>
        </li>
<?php
}

function mdUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo ucwords($_SESSION['firstname'])." ".ucwords($_SESSION['middlename'][0]).". ".ucwords($_SESSION['lastname']); ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo strtoupper($_SESSION['college'])." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-book"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="manage" class="collapse">
                <li>
                    <a href="maListHr.php">Must-Attend</a>
                </li>
                <li>
                    <a href="seminar.php">Seminar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reportsMD.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}

function researchUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo ucwords($_SESSION['firstname'])." ".ucwords($_SESSION['middlename'][0]).". ".ucwords($_SESSION['lastname']); ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo strtoupper($_SESSION['college'])." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="reportsResearch.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}

function faceUI(){
	?>
		<li>
		    <a href="profile.php">
		    <div class="row">
		    	<div class="col-lg-6 col-lg-offset-3 col-xs-12" style="padding-bottom:10px">
		    		<img src="img/avatar.png" alt="" style="width:70px;height:70px;" class="img-circle img-responsive"> 
		    	</div>
		    	<div class="col-sm-12 text-center">
		    		<strong>
		    		<?php echo ucwords($_SESSION['firstname'])." ".ucwords($_SESSION['middlename'][0]).". ".ucwords($_SESSION['lastname']); ?>
		    		</strong>
		    		<h5 class="text-muted"> <?php echo strtoupper($_SESSION['college'])." ".ucwords($_SESSION['user']); ?> </h5>
		    	</div>
		    </div>
		    </a>
		</li>
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="reportsFace.php"><i class="fa fa-fw fa-pie-chart"></i> Reports</a>
        </li>
<?php
}