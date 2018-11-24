<?php

include('../db/config.php');

$action = $_GET['action'];
$result = array();

switch($action){
	case 'department':
		$value = $_GET['value'];
		getDepartment($value);
	break;
	case 'hr-inhouse-department':
		$school = $_GET['school'];
		getSemDept($school);
	break;
	case 'hr-inhouse-employee':
		$key = $_GET['key'];
		$school = $_GET['school'];
		$dept = $_GET['dept'];
		getSemEmp($key,$school,$dept);
	break;
	case 'suggest_emp':
		suggestEmp();
	break;
	case 'track_emp':
		$email = $_GET['value'];
		$ay = $_GET['ay'];
		trackEmp($email,$ay);
	break;
	case 'sem_emp':
		$reqid = $_GET['reqid'];
		$logUser = $_GET['loguser'];
		getMas($reqid,$logUser);
	break;
}


function getDepartment($value){
	$q = mysql_query("SELECT * FROM faith_department WHERE school_id = '$value' ");
	while($rows = mysql_fetch_assoc($q)){
		$result[] = array(
		"id" =>  $rows['id'],
		"department" =>  $rows['department']
		);
	}

	header("content-type: application/json");
	echo json_encode($result);
}

function getSemDept($school){
	if($school!="All"){
		$q = mysql_query("SELECT * FROM faith_department WHERE school_id = '$school' ");
		while($rows = mysql_fetch_assoc($q)){
			echo '
			    <option value="'.$rows['abbr'].'">'.$rows['department'].'</option>
			';
		}
	}else{
		echo "<option></option>";	
	}
	
}

function getSemEmp($key,$school,$dept){
	if($school!="All"){
		if($key!=""){
			$qa = mysql_query("SELECT * FROM profile WHERE (lastname LIKE '%$key%' OR firstname LIKE '%$key%' OR middlename LIKE '%$key%') AND college = '$dept' ");
		}else{
			$qa = mysql_query("SELECT * FROM profile WHERE college = '$dept' ");
		}
	}else{
		if($key!=""){
			$qa = mysql_query("SELECT * FROM profile WHERE lastname LIKE '%$key%' OR firstname LIKE '%$key%' OR middlename LIKE '%$key%' ");
		}else{
			$qa = mysql_query("SELECT * FROM profile");
		}
	}
	
		if(mysql_num_rows($qa)!=0){
		echo '<ul class="list-group">';
			while($rows = mysql_fetch_assoc($qa)){
				echo '
				    <li class="list-group-item search-list" data-email="'.$rows['email'].'">'.$rows['lastname'].', '.$rows['firstname'].' '.$rows['middlename'][0].'. ~ '.$rows['college'].'</li>
				';
			}
		echo '</ul>';
		}else{
			echo "No records found.";
		}
}

function suggestEmp(){
	$emp = array();
	$q = mysql_query("SELECT CONCAT(profile.firstname,' ',profile.lastname)AS name,profile.email  FROM profile");
	while($rows=mysql_fetch_assoc($q)){
		//$emp[] = $rows['name'];
		$emp[] = array(
			"name" => $rows['name'],
			"email" => $rows['email'],
			);
	}

	header("content-type: application/json");
	echo json_encode($emp);
}

function trackEmp($email,$ay){
	?>

		<div class="col-sm-12">
		    <div class="panel panel-default">
		        <div class="panel-heading panel-title">Seminars Attended</div>
		        <div class="panel-body">
		            <div class="row">
		                
		                <div class="col-sm-12">
		                    <div class="table-responsive">
		                        <table class="table table-bordered table-hover">
		                            <thead>
		                                <tr class="active">
		                                    <th class="col-sm-4">Title</th>
		                                    <th class="col-sm-3">Date</th>
		                                    <th class="col-sm-1">TNM</th>
		                                    <th class="col-sm-4">(&#8369;) Budget</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            <?php
		                            $q = mysql_query("
		                                SELECT mustattend.masid,mustattend.title,mustattend.dates,account.usertype,
		                                (
		                                    CASE 
		                                        WHEN sem_emp.type = 'TNA' THEN 'YES'
		                                        ELSE 'NO'
		                                    END
		                                ) as tna

		                                FROM sem_emp 
		                                INNER JOIN mustattend
		                                ON sem_emp.sem_id = mustattend.masid
		                                INNER JOIN account
		                                ON sem_emp.email = account.email
		                                WHERE sem_emp.email = '$email'
		                                AND mustattend.academicyear = '$ay'
		                                ");
		                             $totalBudget = 0;
		                            if(mysql_num_rows($q)!=0){
		                                while($rows=mysql_fetch_assoc($q)){
		                                    $position = $rows['usertype'];
		                                    $masid = $rows['masid'];
		                                    $title = $rows['title'];
		                                    $tna = $rows['tna'];
		                                    $dates = date('M d,Y',strtotime($rows['dates']));

		                                    if($position=="dean"){
		                                        $getMyBudget = mysql_query("SELECT (deanHotel + deanDiem + regDean + transpoDean) as my_budget FROM masbreakdown WHERE masid = '$masid'");
		                                    }else if($position=="chair"){
		                                        $getMyBudget = mysql_query("SELECT (chairHotel + chairDiem + regChair + transpoChair) as my_budget FROM masbreakdown WHERE masid = '$masid'");
		                                    }else if($position=="faculty"){
		                                        $getMyBudget = mysql_query("SELECT (facultyHotel + facultyDiem + regFaculty + transpoFaculty) as my_budget FROM masbreakdown WHERE masid = '$masid'");
		                                    }else{
		                                        echo "HOW?";
		                                    }

		                                    $my_budget = 0;
		                                    if(mysql_num_rows($getMyBudget)!=0){
			                                    while($rows=mysql_fetch_assoc($getMyBudget))
			                                    {
			                                        $my_budget = $rows['my_budget'];
			                                    }
		                                    }
		                                    echo "
		                                    <tr>
		                                        <td>$title</td>
		                                        <td>$dates</td>
		                                        <td>$tna</td>
		                                        <td>$my_budget</td>
		                                    </tr>
		                                    ";
		                                    $totalBudget += $my_budget;
		                                }
		                            }
		                            ?>
		                                <tr>
		                                    <td class="text-right"><strong>Total:</strong></td>
		                                    <td></td>
		                                    <td></td>
		                                    <td><strong> <?php echo $totalBudget; ?> </strong></td>
		                                </tr>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="col-sm-12">
		    <div class="panel panel-default">
		        <div class="panel-heading panel-title">TNM</div>
		        <div class="panel-body">
		            <div class="row">
		                
		                <div class="col-sm-12">
		                    <div class="table-responsive">
		                        <table class="table table-bordered table-hover">
		                            <thead>
		                                <tr class="active">
		                                    <th class="col-sm-4">Job Role Competencies</th>
		                                    <th class="col-sm-1">Position (Importance)</th>
		                                    <th class="col-sm-1">Person (Ability)</th>
		                                    <th class="col-sm-1">Competency</th>
		                                    <th class="col-sm-3">Development Plan</th>
		                                    <th class="col-sm-2">Post-Activity Documents</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            <?php
		                                $q = mysql_query("
		                                SELECT 
		                                job_role,position_importance,
		                                ability,competency,developmentplan,evidence
		                                FROM tna 
		                                WHERE email = '$email'
		                                AND annualyear = '$ay'
		                                ");
		                            if(mysql_num_rows($q)!=0){
		                                while($rows=mysql_fetch_assoc($q)){
		                                    $docs = explode(";", $rows['evidence']);
		                                    echo '
		                                    <tr>
		                                        <td>'.$rows['job_role'].'</td>
		                                        <td>'.$rows['position_importance'].'</td>
		                                        <td>'.$rows['ability'].'</td>
		                                        <td>'.$rows['competency'].'</td>
		                                        <td>'.$rows['developmentplan'].'</td>';

		                                    	echo '<td>';
			                                    foreach($docs as $doc){
			                                        echo '<a href="uploads/'.$doc.'" target="_blank">'.$doc.'</a><br>';
			                                    }
		                                    	echo '</td>';  
		                                    echo '</tr>';
		                                }
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
	<?php
}

function getMas($reqid,$logUser){
	$q = mysql_query("
		SELECT *,
		sem_emp.chair_status AS chair_stat,
		sem_emp.dean_status AS dean_stat,
		sem_emp.vpar_status AS vpar_stat,
		sem_emp.hr_status AS hr_stat,
		sem_emp.md_status AS md_stat,
		(
			(masbreakdown.deanHotel * masbreakdown.numofdean
		    ) + (masbreakdown.chairHotel * masbreakdown.numofchair
		    ) + (masbreakdown.facultyHotel * masbreakdown.numoffaculty
		    )
		+
			(masbreakdown.deanDiem * masbreakdown.numofdean
		    ) + (masbreakdown.chairDiem * masbreakdown.numofchair
		    ) + (masbreakdown.facultyDiem * masbreakdown.numoffaculty
		    )

		+
			(masbreakdown.regDean * masbreakdown.numofdean
		    ) + (masbreakdown.regChair * masbreakdown.numofchair
		    ) + (masbreakdown.regFaculty * masbreakdown.numoffaculty
		    )
		 
		+
			(masbreakdown.transpoDean * masbreakdown.numofdean
		    ) + (masbreakdown.transpoChair * masbreakdown.numofchair
		    ) + (masbreakdown.transpoFaculty * masbreakdown.numoffaculty
		    )

		) AS overall_budget 
		FROM sem_emp 
		INNER JOIN mustattend 
		ON sem_emp.sem_id = mustattend.masid 
		INNER JOIN masbreakdown 
		ON sem_emp.sem_id = masbreakdown.masid 
		WHERE sem_emp.id = '$reqid'
		");
	while($rows=mysql_fetch_assoc($q)){
		$title = $rows['title'];
		$category = $rows['category'];
		$sponsor = $rows['sponsor'];
		$venue = $rows['venue'];
		$date = $rows['dates'];
		$days = $rows['numdays'];
		$budget = $rows['overall_budget'];
		$echo_sched = $rows['echoSched'];
		$documents = $rows['documents'];
		$reasons = $rows['reasons'];

		$chair_stat = $rows['chair_stat'];
		$dean_stat = $rows['dean_stat'];
		$vpar_stat = $rows['vpar_stat'];
		$hr_stat = $rows['hr_stat'];
		$md_stat = $rows['md_stat'];
	}

	?>

    <div class="row">
        <div class="row">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <p class="col-sm-5">
                            <strong>Title: </strong>
                        </p>
                        <p class="col-sm-7" id="rev-semTitle">
                        <?php echo $title; ?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <p class="col-sm-3">
                            <strong>Category: </strong>
                        </p>
                        <p class="col-sm-9" id="rev-semCategory">
                        <?php echo $category; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <p class="col-sm-5">
                            <strong>Sponsoring Org: </strong>
                        </p>
                        <p class="col-sm-7" id="rev-semSponsor">
                        <?php echo $sponsor; ?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <p class="col-sm-3">
                            <strong>Venue: </strong>
                        </p>
                        <p class="col-sm-9" id="rev-semVenue">
                        <?php echo $venue; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Documents and Reasons</div>
                    <div class="panel-body">
                      <div class="col-sm-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label>Invitation/Supporting Documents: </label>
                                <ul class="list-group">
                                    <?php
                                    $docs = explode(";", $documents);
                                    foreach($docs as $doc){
                                    	echo '
                                    	<li class="list-group-item">
                                    	    <u>
                                    	        <a href="uploads/'.$doc.'" target="_blank">'.$doc.'</a>
                                    	    </u>
                                    	</li>
                                    	';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </form>
                      </div>
                      <div class="col-sm-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label>Reasons for Attending: </label>
                                <p id="rev-semReasons">
                                <?php echo $reasons; ?>
                                </p>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Echo Schedule: </label>
                            </div>
                            <div class="col-sm-8">
                                <p id="rev-semEcho">
                                	<?php echo $echo_sched; ?>
                                </p>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Day</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p class="col-sm-6">
                                <strong>Estimated Date: </strong>
                            </p>
                            <p class="col-sm-6" id="rev-date">
                                <?php echo date('M d,Y',strtotime($date)); ?>
                            </p>
                        </div>
                        <div class="row">
                            <p class="col-sm-6">
                                <strong>Number of Days: </strong>
                            </p>
                            <p class="col-sm-6" id="rev-days">
                                <?php echo $days; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Budget</div>
                    <div class="panel-body">
                        <div class="col-sm-12 text-center">
                            <strong>Total Budget Requirement</strong>
                            <h4>&#8369;<span id="rev-totalBudget"><?php echo number_format($budget,2,'.',', ');; ?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>

    <?php

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
                    }       
                }
            }
        }
    }

    if($logUser==$approve){
     	$btn = '
     	<button type="button" class="btn btn-success" id="btn-approve" data-dismiss="modal">
     	    Approve <i class="fa fa-check"></i>
     	</button>
     	';
    }else if($approve=="approve"){
    	$btn = '
    	<button type="button" class="btn btn-primary disabled">
    	    Approved <i class="fa fa-check"></i>
    	</button>
    	';
    }else{
    	$btn = '
    	<button type="button" class="btn btn-success disabled">
    	    Approve <i class="fa fa-check"></i>
    	</button>
    	';
    }

    ?>
    <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<?php echo $btn; ?>

    </div>




	<?php


}
