<?php
    include("action/session-auth.php");
    include("include/head.php");
    include("db/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>

<body>

    <div id="wrapper">

<?php
    include("include/nav.php");
    $ay = $_GET['ay'];
?>

        <div id="page-wrapper">
 
            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Must-Attend <small>Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="maList.php">Must-Attend</a></li>
                        <li class="active">Edit</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <!-- FORM ./. -->
            <form action = "db/db_editMAS.php" method = "POST"> <!--onsubmit = "myFunction()" id = "my-form"--> 
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                        <h3 class="page-header">Details</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <input type="text" id="ma-ay" class="form-control" value="<?php $currentYear = date('Y');
                                                                                        $yearPlusOne = date('Y', strtotime('+1 year'));
                                                                                        echo $currentYear.'-'.$yearPlusOne;?>" name = "ay" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date Created</label>
                                        <input type="text" id="ma-dateCreated" class="form-control" name = "datecreated" value="
                                        <?php $dateTime = date('M d, Y H:ia');
                                                        echo $dateTime;
                                        ?>"readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <select class="form-control ma-category" name = "school">
                                                        <option value="School of Technology">School of Technology</option>
                                                        <option value="School of Management">School of Management</option>
                                                        <option value="School of Humanities">School of Humanities</option>
                                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control ma-category" name = "department">
                                                        <option value="CCIT">CCIT</option>
                                                        <option value="COE">COE</option>
                                                        <option value="COPS">COPS</option>
                                                        <option value="CAS">CAS</option>
                                                        <option value="CIHM">CIHM</option>
                                                    </select>
                                    </div>
								</div>
                            </div>
                        </div>
                    </div>

                <div class="row">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'efs');
                        $result = mysqli_query($conn, "SELECT * FROM mustattend where department='$college' AND academicyear='$ay'");
                            while($row = mysqli_fetch_array($result)){
                            $masid =$row['mas_id'];
                        echo '<div class="col-sm-12">';
                            echo '<h3 class="page-header">Must-Attend Seminars</h3>';
                            echo '<div class="panel panel-default" data-count="1">';
                                echo '<div class="panel-heading">';
                                    echo '<h4 class="panel-title">';
                                        echo '<a data-toggle="collapse" href="#c1">';
                                        echo $row['title'];
                                        $title = $row['mas_id'];
                                        echo '</a>';

                                    echo '</h4>';  
                                    echo '</div>';
                                echo '<div id="c1" class="panel-collapse collapse in ma">';
                                    echo '<div class="panel-body">';
                                        echo '<div class="row">';
                                            echo '<div class="col-sm-5">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Title</label>';
                                                   echo '<input type="text" class="form-control ma-title" value="';
                                                    echo $row['title'];
                                                    echo '" name = "title">'; 
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-sm-3">';
                                                echo '<div class="form-group">';
                                                    echo '<label for="">Category</label>';
                                                    echo '<select class="form-control ma-category" name = "category">';
                                                        if($row['category']=="Research"){
                                                            echo '<option selected="selected" value="Research">Research</option>';
                                                            echo '<option value="Instructions">Instructions</option>';
                                                            echo '<option value="FACE">FACE</option>';
                                                        }else if($row['category']=="Instructions"){
                                                            echo '<option value="Research">Research</option>';
                                                            echo '<option selected="selected" value="Instructions">Instructions</option>';
                                                            echo '<option value="FACE">FACE</option>';
                                                        }else{
                                                            echo '<option value="Research">Research</option>';
                                                            echo '<option value="Instructions">Instructions</option>';
                                                            echo '<option selected="selected" value="FACE">FACE</option>';
                                                        }
                                                       
                                                    echo '</select>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-sm-4">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Sponsoring Org</label>';
                                                    echo '<input type="text" class="form-control ma-sponsor" value="';
                                                    echo $row['sponsor'];
                                                    echo '" name = "sponsor">';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-sm-4">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Date</label>';
                                                    echo '<input type="date" class="form-control ma-date"  value="';
                                                    echo $row['dates'];
                                                    echo '" name = "date">';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-sm-3">';
                                                echo '<div class="form-group">';
                                                    echo '<label>No. of Days</label>';
                                                    echo '<select class="form-control ma-days" name = "days">';

                                                    if($row['days']=="1"){
                                                        echo '<option selected="selected">1</option>';
                                                        echo '<option>2</option>';
                                                        echo '<option>3</option>';
                                                    }else if($row['days']=="2"){
                                                        echo '<option>1</option>';
                                                        echo '<option selected="selected">2</option>';
                                                        echo '<option>3</option>';
                                                    }else if($row['days']=="3"){
                                                        echo '<option>1</option>';
                                                        echo '<option>2</option>';
                                                        echo '<option selected="selected">3</option>';
                                                    }
                                                       
                                                    echo '</select>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-sm-5">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Venue</label>';
                                                    echo '<input type="text" class="form-control ma-venue" value="';
                                                    echo $row['venue'];
                                                    echo '" name = "venue">';
                                                    echo '<input type="text"  style ="width:1px;height;1px;visibility:hidden;" class="form-control ma-masid" value="';
                                                    echo '">';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<h4 class="page-header"><strong>Budget Requirements</strong></h4>';
                                        echo '<div class="row">';
                                            echo '<div class="col-sm-12">';
                                                echo '<div class="table-responsive">';
                                                    echo '<table class="table">';
                                                        echo '<thead>';
                                                            echo '<tr class="active">';
                                                                echo '<th class="col-sm-1">Position</th>';
                                                                echo '<th class="col-sm-1">Quantity</th>';
                                                                echo '<th class="col-sm-1">(&#8369;) Hotel Accommodation <span class="text-muted">x Days</span>                                                                 </th>';
                                                                echo '<th class="col-sm-1">(&#8369;) Per Diem <span class="text-muted">x Days</span></th>';
                                                            echo '</tr>';
                                                        echo '</thead>';
                                                        echo '<tbody>';
                                                            echo '<tr>';
                                //QUERY INPUT!      
													$result1 = mysqli_query($conn, "SELECT * FROM mas_breakdown where mas_list_id='$masid'");
                                                    $row1 = mysqli_fetch_array($result1);
                                                    $result2 = mysqli_query($conn, "SELECT * FROM mustattend where mas_id = '$masid'");
                                                    $row2 = mysqli_fetch_array($result2);
                                                                echo '<td>Dean</td>';
                                                                echo '<td><input type="number" class="form-control ma-deanQty" value="';
                                                                echo $row1['numofdean'];
                                                                echo'" name = "numDean"></td>';
                                                                echo '<td><input type="text" class="form-control ma-deanHotel" value="';
                                                                echo $row1['deanHotel'];
                                                                echo '" readonly name = "hotelDean"></td>';
                                                                echo '<td><input type="text" class="form-control ma-deanDiem" value="';
                                                                echo $row1['deanDiem'];
                                                                echo '" readonly name = "diemDean"></td>';
                                                            echo '</tr>';
                                                            echo '<tr>';
                                                                echo '<td>Chair</td>';
                                                                echo '<td><input type="number" class="form-control ma-chairQty" value="';
                                                                echo $row1['numofchair'];
                                                                echo '"></td>';                             
                                                                echo '<td><input type="text" class="form-control ma-chairHotel" value="';
                                                                echo $row1['chairHotel'];
                                                                echo '" readonly name = "hotelChair"></td>';
                                                                echo '<td><input type="text" class="form-control ma-chairDiem" value="';
                                                                echo $row1['chairDiem'];
                                                                echo '" readonly name = "diemChair"></td>';
                                                            echo '</tr>';
                                                            echo '<tr>';
                                                                echo '<td>Faculty</td>';
                                                                echo '<td><input type="number" class="form-control ma-facQty" value="';
                                                                echo $row1['numoffaculty'];
                                                                echo '"></td>';
                                                                echo '<td><input type="text" class="form-control ma-facHotel" value="';
                                                                echo $row1['facultyHotel'];
                                                                echo '" readonly name = "hotelFaculty"></td>';
                                                                echo '<td><input type="text" class="form-control ma-facDiem" value="';
                                                                echo $row1['facultyDiem'];
                                                                echo '" readonly name = "diemFaculty"></td>';
                                                            echo '</tr>';
                                                            echo '<tr>';
                                                                echo '<td></td>';
                                                                echo '<td class="text-right"><h4 class="ma-pax">';
                                                                $subnum= $row1['numofdean']+$row1['numofchair']+$row1['numoffaculty'];
                                                                echo $subnum;
                                                                echo '</h4></td>';
                                                                echo '<td class="text-right"><h4 class="hotelTotal">';
                                                                $subHotel =  $row1['deanHotel']+$row1['chairHotel']+$row1['facultyHotel'];
                                                                echo $subHotel;
                                                                echo '</h4></td>';
                                                                echo '<td class="text-right"><h4 class="diemTotal">';
                                                                $subDiem = $row1['deanDiem']+$row1['chairDiem']+$row1['facultyDiem']; 
                                                                echo $subDiem;
                                                                echo '</h4></td>';
                                                            echo '</tr>';
                                                        echo '</tbody>';
                                                    echo '</table>';
                                                echo '</div>';
                                                echo '<h4 class="col-sm-12 text-right">';
                                                    $subTotal1 = ($subHotel*$row['days'])+$subDiem;
                                                    echo '<strong>Subtotal: &#8369;<span class="ma-budgetSubtotal1">';
                                                    echo $subTotal1;
                                                    echo '</span></strong>';
                                                echo '</h4>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<hr>';

                                        echo '<div class="row">';
                                            echo '<div class="col-sm-4">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Registration Fee</label>';
                                                    echo '<div class="input-group">';
                                                        echo '<div class="input-group-addon">&#8369;</div>';
                                                        echo '<input type="number" class="form-control ma-regFee" value="';
                                                        echo $row2['reg_total'];
                                                        echo '" name = "Regtotal">';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                             echo '<div class="col-sm-4">';
                                                 echo '<div class="form-group">';
                                                    echo '<label>Food Allowance</label>';
														echo '<div class="input-group">';
															echo '<div class="input-group-addon">&#8369;</div>';
															echo '<input type="number" class="form-control ma-foodFee" value="';
															echo $row1['foodfee'];
															echo '">';
															echo '<div class="input-group-addon">x <span class="days">';
															echo $row['days'];
															echo '</span></div>';
														echo '</div>';
                                                 echo '</div>';
                                             echo '</div>';
                                            echo '<div class="col-sm-4">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Transportation Fee</label>';
                                                    echo '<div class="input-group">';
                                                        echo '<div class="input-group-addon">&#8369;</div>';
                                                        echo '<input type="number" class="form-control ma-transFee" value="';
                                                        echo $row2['transpo_total'];
                                                        echo '" name = "transTotal">';
                                                        echo '<div class="input-group-addon">x <span class="days">';
                                                        echo $row['days']; 
                                                        echo '</span></div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<span class="otherFee"></span>';
                                        echo '</div>';
                                        echo '<div class="row">';
                                            echo '<div class="col-sm-4">';
                                                echo '<button class="btn btn-success btnAddInputOtherFee"><i class="fa fa-plus-circle"></i> Other Fee</button>';
                                            echo '</div>';
                                            echo '<h4 class="col-sm-12 text-right">';
                                                echo '<strong>Subtotal: &#8369;<span class="ma-budgetSubtotal2">';
                                                $subTotal2 = $row2['reg_total']+($row2['transpo_total'])*$row['days'];
                                                echo $subTotal2;
                                                echo '</span></strong>';
                                            echo '</h4>';
                                        echo '</div>';
                                        echo '<hr>';
                                        echo '<div class="row">';
                                            echo '<div class="col-sm-12">';
                                                echo '<h4 class="pull-right">';
                                                    echo '<strong class="text-primary">Total Budget: &#8369;<span class="ma-budgetTotal">';
                                                    $totalBudget = $subTotal1+$subTotal2;
                                                    echo $totalBudget;
                                                    echo '</span></strong>';
                                                echo '</h4>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        echo '<span id="formMa"></span>';
                        echo '<a class="btn btn-primary btnAddFormMa">';
                            echo '<i class="fa fa-plus"></i>';
                             echo 'New';
                        echo '</a>';
                    echo '</div>';

                 ?>   
                </div> 

                <hr>
                <div class="row">
                    <div class="col-sm-6 pull-right text-right">
                        <a data-toggle="modal" data-target="#reviewMA" id="btnSubmitMA" class="btn btn-primary btn-lg">
                            Submit 
                            <i class="fa fa-send"></i>
                        </a>
                    </div>
                </div>
            </div>

    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Must-Attend Modal -->
    <div class="modal fade" id="reviewMA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Must-Attend</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>Academic Year: </strong>
                                    </p>
                                    <p class="col-sm-8 ma-revAy">
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Date Created: </strong>
                                    </p>
                                    <p class="col-sm-9 ma-revDateCreated">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>School: </strong>
                                    </p>
                                    <p class="col-sm-8 ma-revSchool">
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Department: </strong>
                                    </p>
                                    <p class="col-sm-9 ma-revDepartment">
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
                                    <tr class="active">
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Sponsoring Org</th>
                                        <th>Date</th>
                                        <th>Days</th>
                                        <th>Venue</th>
                                        <th>Persons Involved</th>
                                        <!-- <th>No. Of PAX</th> -->
                                        <th>Budget</th>
                                    </tr>
                                </thead>
                                <tbody id="maEach">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    <input type = "submit" onclick="confirmMustAttend()" value = "Confirm" class = "btn btn-primary btn-lg"></input>
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

    <div id="maForm" style="display: none">
        <div class="panel panel-default" data-count="1">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#c1">Must-Attend #1</a>
                </h4>
            </div>
            <div id="c1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control ma-title" name = "title">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control ma-category" name = "category">
                                                        <option value="Research">Research</option>
                                                        <option value="Instructions">Instructions</option>
                                                        <option value="FACE">FACE</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Sponsoring Org</label>
                                <select class="form-control ma-sponsor" name = "sponsor">
                                                        <option value="CCIT">CCIT</option>
                                                        <option value="COE">COE</option>
                                                        <option value="COPS">COPS</option>
                                                        <option value="CIHM">CIHM</option>
                                                        <option value="CAS">CAS</option>
                                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control ma-date" name = "date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>No. of Days</label>
                                <select class="form-control ma-days" name = "days">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Venue</label>
                                <input type="text" class="form-control ma-venue" name = "venue">
                            </div>
                        </div>
                    </div>
                    <h4 class="page-header"><strong>Budget Requirements</strong></h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="active">
                                            <th class="col-sm-1">Position</th>
                                            <th class="col-sm-1">Quantity</th>
                                            <th class="col-sm-1">(&#8369;) Hotel Accommodation</th>
                                            <th class="col-sm-1">(&#8369;) Per Diem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Dean</td>
                                            <td><input type="number" class="form-control ma-deanQty" value="0" name = "numDean"></td>
                                                                <td><input type="text" class="form-control ma-deanHotel" value="0" name = "hotelDean" readonly></td>
                                                                <td><input type="text" class="form-control ma-deanDiem" value="0" name = "diemDean" readonly></td>
                                        <tr>
                                            <td>Chair</td>
                                            <td><input type="number" class="form-control ma-chairQty" name = "numChair" value="5"></td>
                                                                <td><input type="text" class="form-control ma-chairHotel" value="0" name = "hotelChair" readonly></td>
                                                                <td><input type="text" class="form-control ma-chairDiem" value="0" name = "diemChair" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Faculty</td>
                                            <td><input type="number" class="form-control ma-facQty" value="5" name = "numFaculty"></td>
                                                                <td><input type="text" class="form-control ma-facHotel" value="0" readonly name ="hotelFaculty">                                                                 </td>
                                                                <td><input type="text" class="form-control ma-facDiem" value="0" readonly name = "diemFaculty">                                                                 </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-right"><h4 class="ma-pax" name = "person">0</h4></td>
                                                                <td class="text-right"><h4 class="hotelTotal" name = "totalHotel">0</h4></td>
                                                                <td class="text-right"><h4 class="diemTotal" name = "totalDiem">0</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="col-sm-12 text-right">
                                <strong>Subtotal: &#8369;<span class="ma-budgetSubtotal1"></span></strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Registration Fee</label>
                                <div class="input-group">
                                    <div class="input-group-addon">&#8369;</div>
                                    <input type="number" class="form-control ma-regFee" name = "Regtotal">
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label>Food Allowance</label>
                                <div class="input-group">
                                    <div class="input-group-addon">&#8369;</div>
                                    <input type="number" class="form-control ma-foodFee">
                                    <div class="input-group-addon">x <span class="days">1</span></div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Transportation Fee</label>
                                <div class="input-group">
                                    <div class="input-group-addon">&#8369;</div>
                                    <input type="number" class="form-control ma-transFee" name = "transTotal">
                                    <div class="input-group-addon">x <span class="days">1</span></div>
                                </div>
                            </div>
                        </div>
                        <span class="otherFee"></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-success btnAddInputOtherFee"><i class="fa fa-plus-circle"></i> Other Fee</button>
                        </div>
                        <h4 class="col-sm-12 text-right">
                            <strong>Subtotal: &#8369;<span class="ma-budgetSubtotal2"></span></strong>
                        </h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-right">
                                <strong class="text-primary">Total Budget: &#8369;<span class="ma-budgetTotal"></span></strong>
                                <input type="hidden" name="budgetTotal" id="budgetTotal" value="not yet defined">
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <script>
// This function gets called once the user submits the form
function myFunction(){

    // First get the value from the cronMDMtimer-span
    budgetTotal = $('.ma-budgetTotal').html();

    // Then store the extracted timerValue in a hidden form field
    $("#budgetTotal").val(budgetTotal);

    // submit the form using it's ID "my-form"
    $("#my-form").submit();
}
</script>

    <script>
    var num=0;
    var titles;
    var count=0;
    var deanNumber=[];
    var chairNumber=[];
    var facNumber=[];
    var deanHotel=[];
    var chairHotel=[];
    var facHotel=[];
    var deanDiem=[];
    var chairDiem=[];
    var facDiem=[];
    var regFee=[];
    var foodFee=[];
    var transFee=[];
    var mas_id=[];
    var masids=[];
        $(function(){
            var deanH = 1000; //dean hotel
            var deanD = 800; // dean diem
            var chairH = 800; //chair hotel
            var chairD = 500; //chair diem
            var facH = 500; //faculty hotel
            var facD = 300; //faculty hotel

            $('#btnSubmitMA').click(function(){
                var ay = $('#ma-ay').val();
                var dateCreated = $('#ma-dateCreated').val();
                var school = $('#ma-school').val();
                var department = $('#ma-department').val();
                var ma = [];
                var counter=0;
                $(".ma").each(function(){
                    var eachMa =
                        {
                            titles: $(this).find('.ma-title').val(),
                            category: $(this).find('.ma-category').val(),
                            sponsor: $(this).find('.ma-sponsor').val(),
                            date: $(this).find('.ma-date').val(),
                            days: $(this).find('.ma-days').val(),
                            venue: $(this).find('.ma-venue').val(),
                            dean: $(this).find('.ma-deanQty').val(),
                            chair: $(this).find('.ma-chairQty').val(),
                            faculty: $(this).find('.ma-facQty').val(),
                            //pax: $(this).find('.ma-pax').val(),
                            budget: $(this).find('.ma-budgetTotal').text(),
                        };
                    counter++;
                    deanNumber[counter]=$(this).find('.ma-deanQty').val();
                    chairNumber[counter]=$(this).find('.ma-chairQty').val();
                    facNumber[counter]=$(this).find('.ma-facQty').val();
                    deanHotel[counter]=$(this).find('.ma-deanHotel').val();
                    chairHotel[counter]=$(this).find('.ma-chairHotel').val();
                    facHotel[counter]=$(this).find('.ma-facHotel').val();
                    deanDiem[counter]=$(this).find('.ma-deanDiem').val();
                    chairDiem[counter]=$(this).find('.ma-chairDiem').val();
                    facDiem[counter]=$(this).find('.ma-facDiem').val();
                    regFee[counter]=$(this).find('.ma-regFee').val();
                    foodFee[counter]=$(this).find('.ma-foodFee').val();
                    transFee[counter]=$(this).find('.ma-transFee').val();
                    masids[counter]=$(this).find('.ma-masid').val();
                    ma.push(eachMa);
                });
/// on going
                var mas = [
                    {
                        ay: ay,
                        dateCreated: dateCreated,
                        school: school,
                        department: $('#ma-department').val(),
                        ma: ma
                    }
                ];

                $('.ma-revAy').html(ay);
                $('.ma-revDateCreated').html(dateCreated);
                $('.ma-revSchool').html(school);
                $('.ma-revDepartment').html(department);

                $('#maEach').html();
                $.each(ma, function(key, val){
                    num+=1;
                    count+=1;
                    $('#maEach').append('\
                        <tr>\
                            <td id="title'+num+'">'+ma[key].title+'</td>\
                            <td id="category'+num+'">'+ma[key].category+'</td>\
                            <td id="sponsor'+num+'">'+ma[key].sponsor+'</td>\
                            <td id="date'+num+'">'+ma[key].date+'</td>\
                            <td id="days'+num+'">'+ma[key].days+'</td>\
                            <td id="venue'+num+'">'+ma[key].venue+'</td>\
                            <td id="person'+num+'">'+ma[key].dean+" Dean; "+ma[key].chair+" Chair; "+ma[key].faculty+" Faculty"+'</td>\
                            <td id="budget'+num+'">&#8369;'+ma[key].budget+'</td>\
                        </tr>\
                        ');
                });
                num=0;
                console.log(mas);

            });

            var c = 1;
            $('.btnAddFormMa').click(function(){
                c += 1;
                $('#maForm').find('.panel').attr('data-count', c);
                $('#maForm').find('a').prop('href','#c'+c).html('Must-Attend #'+c);
                $('#maForm').find('.panel-collapse').prop('id','c'+c).addClass('ma');
                $('#formMa').append($('#maForm').html());
                $('#maForm').find('.panel-collapse').removeClass('.ma');
            });

            $(document).on('keyup', '.ma-title', function(){
                var title = $(this).val();

                if(title!=""){
                    $(this).closest('.panel').find('a').html(title);
                }else{
                    var count = $(this).closest('.panel').data('count');
                    $(this).closest('.panel').find('a').html('Must-Attend #'+count);
                }
            });

            $(document).on('click', '.btnAddOtherFee', function(){
                $(this).closest('.ma').find('.btnAddInputOtherFee').show();
                var title = $(this).closest('.ma').find('.titleOther').val();
                $(this).closest('.ma').find('.otherFee').append('\
                    <div class="col-sm-4 inputOtherFee">\
                        <div class="form-group">\
                            <label>'+title+'</label>\
                            <div class="input-group">\
                                <div class="input-group-addon">&#8369;</div>\
                                <input type="number" class="form-control ma-otherFee" data-title="'+title+'">\
                                <div class="input-group-btn">\
                                    <button class="btn btn-danger btnRemoveOtherFee"><i class="fa fa-times"></i></button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ');
                $(this).closest('.titleOtherInput').remove();
            });

            $(document).on('click', '.btnRemoveOtherFee',function(){
                if($(this).closest('.ma').find('.ma-budgetSubtotal2').text()!=""){
                    var sub2 = parseInt($(this).closest('.ma').find('.ma-budgetSubtotal2').text());
                }else{
                    var sub2 = 0;
                }
                var otherFeeVal = $(this).closest('.inputOtherFee').find('.ma-otherFee').val();
                var total = sub2 - otherFeeVal;
                console.log(total);
                $(this).closest('.ma').find('.ma-budgetSubtotal2').text(total);
                computeTotalBudget(this);
                $(this).closest('.inputOtherFee').remove();
            });

            $(document).on('click', '.btnCancelOtherFee', function(){
                $(this).closest('.ma').find('.btnAddInputOtherFee').show();
                $(this).closest('.titleOtherInput').remove();
            });

            $(document).on('click', '.btnAddInputOtherFee', function(){
                $(this).hide();
                $(this).closest('.ma').find('.otherFee').append('\
                    <span class="titleOtherInput">\
                        <div class="clearfix"></div>\
                        <div class="col-sm-4">\
                            <div class="input-group">\
                                <input type="text" class="form-control titleOther" placeholder="Others Fee">\
                                <div class="input-group-btn">\
                                    <button class="btn btn-success btnAddOtherFee"><i class="fa fa-check"></i></button>\
                                    <button class="btn btn-danger btnCancelOtherFee"><i class="fa fa-ban"></i></button>\
                                </div>\
                            </div>\
                        </div>\
                    </span>\
                    ');
            });

            $(document).on('change', '.ma-days',function(){
                $('.days').html($(this).val());
                // computeSubtotal1(this);
                computeTable(this);
                computeSubtotal2(this);
            });

            $(document).on('keyup', '.ma-deanQty',function(){
                computeTable(this);
            });

            $(document).on('keyup', '.ma-chairQty',function(){
                computeTable(this);
            });

            $(document).on('keyup', '.ma-facQty',function(){
                computeTable(this);
            });

            function computeTable(element){
                var days = parseInt($(element).closest('.ma').find('.ma-days').val());
                var deanQty = $(element).closest('.ma').find('.ma-deanQty').val();
                if(deanQty!=0){
                    var deanHotelTotal = (deanH*deanQty)*days;
                    var deanDiemTotal = (deanD*deanQty)*days;
                    $(element).closest('.ma').find('.ma-deanHotel').val(deanHotelTotal);
                    $(element).closest('.ma').find('.ma-deanDiem').val(deanDiemTotal);
                    computeSubtotal1(element);
                }else{
                    $(element).closest('.ma').find('.ma-deanHotel').val(0);
                    $(element).closest('.ma').find('.ma-deanDiem').val(0);
                    computeSubtotal1(element);
                }
                var chairQty = $(element).closest('.ma').find('.ma-chairQty').val();
                if(chairQty!=0){
                    var chairHotelTotal = (chairH*chairQty)*days;
                    var chairDiemTotal = (chairD*chairQty)*days;
                    $(element).closest('.ma').find('.ma-chairHotel').val(chairHotelTotal);
                    $(element).closest('.ma').find('.ma-chairDiem').val(chairDiemTotal);
                    computeSubtotal1(element);
                }else{
                    $(element).closest('.ma').find('.ma-chairHotel').val(0);
                    $(element).closest('.ma').find('.ma-chairDiem').val(0);
                    computeSubtotal1(element);
                }
                var facQty = $(element).closest('.ma').find('.ma-facQty').val();
                if(facQty!=0){
                    var facHotelTotal = (facH*facQty)*days;
                    var facDiemTotal = (facD*facQty)*days;
                    $(element).closest('.ma').find('.ma-facHotel').val(facHotelTotal);
                    $(element).closest('.ma').find('.ma-facDiem').val(facDiemTotal);
                    computeSubtotal1(element);
                }else{
                    $(element).closest('.ma').find('.ma-facHotel').val(0);
                    $(element).closest('.ma').find('.ma-facDiem').val(0);
                    computeSubtotal1(element);
                }
            }

            function computeSubtotal1(element){
                var deanHotelTotal = parseInt($(element).closest('.ma').find('.ma-deanHotel').val());
                var chairHotelTotal = parseInt($(element).closest('.ma').find('.ma-chairHotel').val());
                var facHotelTotal = parseInt($(element).closest('.ma').find('.ma-facHotel').val());
                var deanDiemTotal = parseInt($(element).closest('.ma').find('.ma-deanDiem').val());
                var chairDiemTotal = parseInt($(element).closest('.ma').find('.ma-chairDiem').val());
                var facDiemTotal = parseInt($(element).closest('.ma').find('.ma-facDiem').val());
                var days = parseInt($(element).closest('.ma').find('.ma-days').val());


                if($(element).closest('.ma').find('.ma-deanQty').val()!=""){
                    var deanTotal = parseInt($(element).closest('.ma').find('.ma-deanQty').val());
                }else{
                    var deanTotal = 0;
                }
                if($(element).closest('.ma').find('.ma-chairQty').val()!=""){
                    var chairTotal = parseInt($(element).closest('.ma').find('.ma-chairQty').val());
                }else{
                    var chairTotal = 0;
                }
                if($(element).closest('.ma').find('.ma-facQty').val()!=""){
                    var facTotal = parseInt($(element).closest('.ma').find('.ma-facQty').val());
                }else{
                    var facTotal = 0;
                }

                
                var pax = deanTotal+chairTotal+facTotal;
                // console.log(chairTotal);
                var hotelTotal = (deanHotelTotal+chairHotelTotal+facHotelTotal)*days;
                console.log(hotelTotal);
                var diemTotal = deanDiemTotal+chairDiemTotal+facDiemTotal;
                $(element).closest('.ma').find('.ma-pax').html(pax);
                $(element).closest('.ma').find('.hotelTotal').html(hotelTotal);
                $(element).closest('.ma').find('.diemTotal').html(diemTotal);

                var subTotal1 = parseInt(hotelTotal)+parseInt(diemTotal);
                $(element).closest('.ma').find('.ma-budgetSubtotal1').html(subTotal1);
                computeTotalBudget(element);
            }

            $(document).on('keyup', '.ma-regFee',function(){
                computeSubtotal2(this);
            });

            $(document).on('keyup', '.ma-foodFee',function(){
                computeSubtotal2(this);
            });

            $(document).on('keyup', '.ma-transFee',function(){
                computeSubtotal2(this);
            });

            function computeSubtotal2(element){
                var days = parseInt($(element).closest('.ma').find('.ma-days').val());

                if($(element).closest('.ma').find('.ma-regFee').val()!=""){
                    var regFee = parseInt($(element).closest('.ma').find('.ma-regFee').val());
                }else{
                    var regFee = 0;
                }
                if($(element).closest('.ma').find('.ma-foodFee').val()!=""){
                    var foodFee = parseInt($(element).closest('.ma').find('.ma-foodFee').val());
                }else{
                    var foodFee = 0;
                }
                if($(element).closest('.ma').find('.ma-transFee').val()!=""){
                    var transFee = parseInt($(element).closest('.ma').find('.ma-transFee').val());
                }else{
                    var transFee = 0;
                }

                //other fee
                var otherFeeTotal = 0;
                var a = $(element).closest('.ma').find('.ma-otherFee');
                $.each(a, function(){
                    if($(this).val()!=""){
                        var otherFee = parseInt($(this).val());
                        otherFeeTotal = otherFeeTotal+otherFee;
                    }else{
                        var otherFee = 0;
                    }
                });

                var foodFeeTotal = foodFee*days;
                var transFeeTotal = transFee*days;
                // var subTotal = regFee+foodFeeTotal+transFeeTotal+otherFeeTotal;
                var subTotal = regFee+foodFeeTotal+transFeeTotal+(otherFeeTotal*days);

                $(element).closest('.ma').find('.ma-budgetSubtotal2').html(subTotal);
                // console.log(foodFeeTotal);

                computeTotalBudget(element);
            }

            function computeTotalBudget(element){
                if($(element).closest('.ma').find('.ma-budgetSubtotal1').text()!=""){
                    var sub1 = parseInt($(element).closest('.ma').find('.ma-budgetSubtotal1').text());
                }else{
                    var sub1 = 0;
                }
                if($(element).closest('.ma').find('.ma-budgetSubtotal2').text()!=""){
                    var sub2 = parseInt($(element).closest('.ma').find('.ma-budgetSubtotal2').text());
                }else{
                    var sub2 = 0;
                }
                var total = sub1+sub2;
                // console.log(sub1);
                $(element).closest('.ma').find('.ma-budgetTotal').html(total);
            }


            $(document).on('keyup', '.ma-otherFee', function(){
                computeSubtotal2(this);
            });

        });

        //HERE AUTOSAVE!!!
        function confirmMustAttend(){
            var notif;
            var counts=0;
            var ay = document.getElementById("ma-ay").value;
            var datecreated = new Date();//document.getElementById("ma-dateCreated").value;
            var school = document.getElementById("ma-school").value;
            var department = document.getElementById("ma-department").value;
     for( var x=1;x<=count;x++){
            var x = 1;
            var title=document.getElementById("title"+x).innerText;
            var category=document.getElementById("category"+x).innerText;
            var sponsor=document.getElementById("sponsor"+x).innerText;
            var date=document.getElementById("date"+x).innerText;
            var days=document.getElementById("days"+x).innerText;
            var venue=document.getElementById("venue"+x).innerText;
            var person=document.getElementById("person"+x).innerText;
            var budget=document.getElementById("budget"+x).innerText;
            var numDean=deanNumber[x];
            var numChair=chairNumber[x];
            var numFaculty=facNumber[x];
            var hotelDean=deanHotel[x];
            var hotelChair = chairHotel[x];
            var hotelFaculty = facHotel[x];
            var diemDean = deanDiem[x];
            var diemChair = chairDiem[x];
            var diemFaculty = facDiem[x];
            var feeReg = regFee[x];
            var feeFood = foodFee[x];
            var feeTrans = transFee[x];
            var idmas =  masids[x];
            // alert(ay+datecreated+school+department+title+category+sponsor+date+days+venue+person+budget);
            var xmlhttp = new XMLHttpRequest();
            var ip ="http://localhost/db/";
            var url = ip+"db_editMAS.php";
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 xmlhttp.onreadystatechange=function() {

                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                   var data = JSON.parse(xmlhttp.responseText);
                     notif =data.notification;
                    }
                    
                  }
                      xmlhttp.send("ay="+ ay +
                      "&"+"datecreated=" + datecreated +
                      "&"+"school=" + school +
                      "&"+"department=" + department +
                      "&"+"title=" + title+
                      "&"+"category=" + category+
                      "&"+"sponsor=" + sponsor+
                      "&"+"date=" + date+
                      "&"+"days=" + days+
                      "&"+"venue=" + venue+
                      "&"+"person=" + person+
                      "&"+"budget=" + budget+
                      "&"+"numDean=" + numDean +
                      "&"+"numChair=" +  numChair +
                      "&"+"numFaculty=" + numFaculty +
                      "&"+"hotelDean=" + hotelDean+
                      "&"+"hotelChair=" + hotelChair+
                      "&"+"hotelFaculty=" + hotelFaculty+
                      "&"+"diemDean=" + diemDean+
                      "&"+"diemChair=" + diemChair+
                      "&"+"diemFaculty=" + diemFaculty+
                      "&"+"feeReg=" + feeReg+
                      "&"+"feeFood=" + feeFood+
                      "&"+"feeTrans=" + feeTrans+
                      "&"+"idmas=" + idmas);
             counts++;
            if(counts==count){
                alert("Successfully edit must attend seminar");
                header('Location: maEdit.php');
            }
        }
    count=0;
    }
       
    </script>
    
</body>

</html>
