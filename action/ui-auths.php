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
			# code...
		break;

		case 'research':
			# code...
		break;

		case 'soci':
			# code...
		break;
		
		default:
		header("location: ../login.php?login=failed");
		break;
	}

function chairUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="maLists.php">Must-Attend</a>
	                </li>
	                <li>
	                    <a href="tna.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	                <li>
	                    <a href="othersCreate.php">Others</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="track.php"><i class="fa fa-fw fa-table"></i> Track</a>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}


function facUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="tnaFac.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}

function staffUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="tnaFac.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}


function deanUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="maListDean.php">Must-Attend</a>
	                </li>
	                <li>
	                    <a href="tnaDean.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	                <li>
	                    <a href="othersCreate.php">Others</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="track.php"><i class="fa fa-fw fa-table"></i> Track</a>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}

function vparUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="maListVpar.php">Must-Attend</a>
	                </li>
	                <li>
	                    <a href="tnaVpar.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminar.php">Seminar</a>
	                </li>
	                <li>
	                    <a href="othersCreate.php">Others</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="track.php"><i class="fa fa-fw fa-table"></i> Track</a>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}

function hrUI(){
	?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav side-nav">
	        <li class="active">
	            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	        </li>
	        <li>
	            <a href="javascript:void(0)" data-toggle="collapse" data-target="#manage"><i class="fa fa-fw fa-arrows-v"></i> Manage <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="manage" class="collapse">
	                <li>
	                    <a href="maListHr.php">Must-Attend</a>
	                </li>
	                <li>
	                    <a href="tnaHr.php">TNA</a>
	                </li>
	                <li>
	                    <a href="seminarHr.php">Seminar</a>
	                </li>
	                <li>
	                    <a href="others.php">Others</a>
	                </li>
	            </ul>
	        </li>
	        <li>
	            <a href="track.php"><i class="fa fa-fw fa-table"></i> Track</a>
	        </li>
	        <li>
	            <a href="reports.php"><i class="fa fa-fw fa-table"></i> Reports</a>
	        </li>
	        <li>
	            <a href="activities.php"><i class="fa fa-fw fa-table"></i> Activities</a>
	        </li>
	    </ul>
	</div>
<?php
}