<?php
include("action/session-auth.php");
include("db/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>
<?php
    include("include/head.php");
?>

<body>

    <div id="wrapper">

<?php
    include("include/nav.php");
?>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'efs');
    // $ay = $_SESSION['ay'];
     $result = mysqli_query($conn, "SELECT * FROM mustattend");
        $row = mysqli_fetch_array($result);
            $datecreated= $row['dates'];
			$title = $row['title'];
			$venue= $row['venue'];
			$sponsor = $row['sponsor'];
			$academicyear= $row['academicyear'];
			$budget = $row['budget'];
			$days= $row['days'];
			$person= $row['person'];
			$category = $row['category'];
	$resulta = mysqli_query($conn, "SELECT * FROM mas_breakdown");
        $rowa = mysqli_fetch_array($resulta);
            $numofdean= $rowa['numofdean'];
			$numofchair = $rowa['numofchair'];
			$numoffaculty = $rowa['numoffaculty'];
			$deanHotel= $rowa['deanHotel'];
			$deanDiem = $rowa['deanDiem'];
			$transfeeDean = $rowa['transfeeDean'];
			$regfeeChair= $rowa['regfeeChair'];
			$regfeeDean = $rowa['regfeeDean'];
			$regfeeFaculty = $rowa['regfeeFaculty'];
			$transfeeChair= $rowa['transfeeChair'];
			$chairDiem = $rowa['chairDiem'];
			$chairHotel = $rowa['chairHotel'];
			$transfeeFaculty= $rowa['transfeeFaculty'];
			$facultyDiem = $rowa['facultyDiem'];
			$facultyHotel = $rowa['facultyHotel'];
			
			$totalHotel = $rowa['deanHotel']+$rowa['chairHotel']+$rowa['facultyHotel'];
			$hotel = number_format($totalHotel);
			$totalDiem = $rowa['deanDiem']+$rowa['chairDiem']+$rowa['facultyDiem'];
            $diem = number_format($totalDiem);
			$totalReg = $rowa['regfeeDean']+$rowa['regfeeChair']+$rowa['regfeeFaculty'];
            $reg= number_format($totalReg);
			$totalTranspo = $rowa['transfeeDean']+$rowa['transfeeChair']+$rowa['transfeeFaculty'];
            $transpo = number_format($totalTranspo);
			$totalbudget =$totalHotel+$totalDiem+$totalReg+($totalTranspo*2);
            $budgetTotal =  number_format($totalbudget);   
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Seminars <small>New Request</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="seminar.php">Seminars</a></li>
                        <li class="active">New Request</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-sm-12">
                    <form role="form">

                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-header">Employee Details</h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Employee Name</label>
                                              <input type="text" class="form-control" value="<?php echo "$firstname $lastname"; ?>" id="sem-empName" readonly>
                                        </div>
                                    </div>
                                   <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Date Created</label>
                                            <input type="text" class="form-control" id="sem-dateCreated" value="<?php echo date('M d, Y H:ia'); ?>" readonly>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Position</label>
                                            <input type="text" class="form-control" id="sem-position" value="<?php echo $_SESSION['college']." ".ucwords($_SESSION['user']); ?>" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" id="sem-email" value="<?php echo $email; ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control" id="sem-department" value="<?php echo $college; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <h3 class="page-header">Seminar Details</h3>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label class="control-label">Title of Seminar</label>
                                                    <input type="text" class="form-control" id="sem-semName" autofocus>
                                                    <!-- <div class="input-group">
                                                        <input type="text" class="form-control" id="sem-semName" autofocus>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MAS <span class="caret"></span></button>
                                                            <ul class="dropdown-menu dropdown-menu-right" id="sem-semType">
                                                                <li><a href="javascript:void(0)">MAS</a></li>
                                                                <li><a href="javascript:void(0)">TNA</a></li>
                                                            </ul>
                                                        </div>
                                                    </div> -->
                                                    <input type="hidden" id="sem-semId">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                <label for="">&nbsp;</label>
                                                    <select id="sem-semType" class="form-control">
                                                        <option>MAS</option>
                                                        <option>TNA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select class="form-control ma-category">
                                        <option value="Research">Research</option>
                                        <option value="Instructions">Instructions</option>
                                        <option value="FACE">FACE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Sponsoring Org</label>
                                    <input type="text" class="form-control ma-sponsor">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control ma-date">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>No. of Days</label>
                                    <select class="form-control ma-days">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Venue</label>
                                    <input type="text" class="form-control ma-venue">
                                </div>
                            </div>
                                        <div class="form-group">
                                            <label class="control-label">Invitation/Supporting Documents</label>
                                            <input type="file" id="docs" class="form-control" multiple>
                                            <p class="help-block">You can select more than one file.</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Reasons for Attending</label>
                                            <textarea rows="5" id="sem-reasons" class="form-control"></textarea>
                                        </div>
                                        
                                        <div class="col-sm-12">
                        
                       
                        <hr>
                       
                    </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Details
                                            </div>
                                            <div class="panel-body">
												<div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Title:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-ay">
                                                        <?php echo $title ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Academic Year:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-ay">
                                                        <?php echo $academicyear ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Category:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-category">
                                                        <?php echo $category ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Sponsoring Org:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-sponsor">
                                                        <?php echo $sponsor ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Venue:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-venue">
                                                        <?php echo $venue ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Date:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-date">
                                                        <?php echo $datecreated ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>No. of Days: </label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-days">
                                                        <?php echo $days ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p><strong id="sem-persons"> <center>
														<?php echo $person ?>
														</strong> persons will be attending this seminar including:</p>
                                                        <?php echo $numofdean ?> Dean/s, 
														<?php echo $numofchair ?> Chair/s,
														<?php echo $numoffaculty ?> Faculty/ies, 
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <ul class="list-group">
                                                            <span id="sem-attendees"></span>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <strong>Your Budget</strong>
														<br>
														<?php echo $budgetTotal ?>
														</br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pull-right text-right">
                                <a data-toggle="modal" id="btnRev" data-target="#reviewSeminar" class="btn btn-primary btn-lg">
                                Submit 
                                <i class="fa fa-send"></i>
                                </a>
                            </div>
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

    <!-- Seminar Modal -->
    <div class="modal fade" id="reviewSeminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Seminar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <p class="col-sm-5">
                                            <strong>Title: </strong>
                                        </p>
                                        <p class="col-sm-7" id="rev-semTitle">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <p class="col-sm-3">
                                            <strong>Category: </strong>
                                        </p>
                                        <p class="col-sm-9" id="rev-semCategory">
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
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <p class="col-sm-3">
                                            <strong>Venue: </strong>
                                        </p>
                                        <p class="col-sm-9" id="rev-semVenue">
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
                                                <ul class="list-group" id="rev-doclist">
                                                </ul>
                                            </div>
                                        </form>
                                      </div>
                                      <div class="col-sm-6">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label>Reasons for Attending: </label>
                                                <p id="rev-semReasons">
                                                </p>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Echo Schedule: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p id="rev-semEcho"></p>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-7">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Persons Involved</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p><strong id="rev-persons">8</strong> persons will be joining this seminar including: <strong id="rev-includes">Heads,Faculty and Staffs</strong></p>
                                            <div class="list-group">
                                                <span id="rev-attendees"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                     <div class="col-sm-12">
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
                                                        Jan. 02, 2017
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-6">
                                                        <strong>Number of Days: </strong>
                                                    </p>
                                                    <p class="col-sm-6" id="rev-days">
                                                        5
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Budget</div>
                                            <div class="panel-body">
                                                <div class="col-sm-12 text-center">
                                                    <strong>Total Budget Requirement</strong>
                                                    <h4>&#8369;<span id="rev-totalBudget"></span></h4>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                <hr>
                                                    <strong>Your Budget</strong>
                                                    <h4>&#8369;<span id="rev-myBudget"></span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    <a class="btn btn-primary btn-lg" id="btnConfirm">Confirm</a>
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

    <script src="plugins/typeahead/bootstrap3-typeahead.min.js"></script>


    <script id="echoTemp" type="text/x-custom-template">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Echo Schedule</label>
                <input type="date"  class="form-control sem-echoSched">
            </div>
        </div>
    </script>
    
    <script>
        $(function(){

            $.get('action/loadAllMa.php', { 
                action: 'suggest',
                email: $("#sem-email").val(),
                dept: $("#sem-department").val()
                 } ,function(data){
                    console.log(data);
                $('#sem-semName').typeahead({
                    source: data,
                    afterSelect: function(){
                        loadMa();
                    }
                });
            });

            function loadMa(){
                var semTitle = $('#sem-semName').val();
                var email = $('#sem-email').val();
                $.get('action/loadAllMa.php', { 
                    action: 'find', 
                    title: semTitle,
                    email: email,
                } ,function(data){
                    alert("Loaded!");
                    if(data!="empty"){
                        console.log(data);
                        $("#sem-attendees").empty();
                        $("#sem-semId").val(data.masid);
                        $("#sem-ay").html(data.academicyear);
                        $("#sem-category").html(data.category);
                        $("#sem-sponsor").html(data.sponsor);
                        $("#sem-venue").html(data.venue);
                        $("#sem-date").html(data.dates);
                        $("#sem-days").html(data.numdays);
                        $("#sem-persons").html(data.persons);
                        $("#sem-includes").html(data.includes);
                        $("#sem-totalBudget").html(data.budget[0].proposed_budget);
                        $("#sem-myBudget").html(data.budget[0].my_budget);
                        $.each(data.attendees, function(key, val){
                            $("#sem-attendees").append('\
                                <li class="list-group-item">\
                                    <strong>'+data.attendees[key].firstname+' '+data.attendees[key].lastname+'</strong>\
                                    <p class="list-group-item-text text-muted">\
                                        '+data.attendees[key].position+'\
                                    </p>\
                                </li>\
                                ');
                        });
                    }else{
                        console.log(data);
                        $("#sem-ay").html("N/A");
                        $("#sem-sponsor").html("N/A");
                        $("#sem-venue").html("N/A");
                        $("#sem-date").html("N/A");
                        $("#sem-days").html("N/A");
                    }
                });
            }

            $('.btnAddEcho').click(function(){
                $('#echoSched').append($('#echoTemp').html());
            });


            $("#btnRev").click(function(){

                $("#rev-semTitle").empty();
                $("#rev-semCategory").empty();
                $("#rev-semSponsor").empty();
                $("#rev-semVenue").empty();
                $("#rev-semReasons").empty();

                $("#rev-persons").empty();
                $("#rev-includes").empty();
                $("#rev-attendees").empty();
                $("#rev-date").empty();
                $("#rev-days").empty();

                $("#rev-semTitle").html($("#sem-semName").val());
                $("#rev-semCategory").html($("#sem-category").html());
                $("#rev-semSponsor").html($("#sem-sponsor").html());
                $("#rev-semVenue").html($("#sem-venue").html());
                $("#rev-semReasons").html($("#sem-reasons").val());

                $("#rev-semEcho").empty();
                $(".sem-echoSched").each(function(){
                    $("#rev-semEcho").append('\
                        <br>'+$(this).val()+'\
                        ');
                });

                $("#rev-persons").html($("#sem-persons").html());
                $("#rev-includes").html($("#sem-includes").html());
                $("#rev-attendees").html($("#sem-attendees").html());
                $("#rev-date").html($("#sem-date").html());
                $("#rev-days").html($("#sem-days").html());
                $("#rev-totalBudget").html($("#sem-totalBudget").html());
                $("#rev-myBudget").html($("#sem-myBudget").html());

                $("#rev-doclist").empty();
                var files = $("#docs").prop("files");
                $.each(files, function(key,val){
                    $("#rev-doclist").append('\
                        <li class="list-group-item">\
                            <u class="text-primary">\
                                '+files[key].name+'\
                            </u>\
                        </li>\
                        ');
                });

            });

            $("#btnConfirm").click(function(){
                var fd = new FormData();

                fd.append('masid',$("#sem-semId").val());
                fd.append('email',$("#sem-email").val());
                fd.append('echoSched',$(".sem-echoSched").val());
                var files = $("#docs").prop('files');
                $.each(files, function(key, val){
                    fd.append('docs[]',files[key],files[key].name);
                });
                fd.append('reasons',$("#sem-reasons").val());
                fd.append('type',$("#sem-semType").val());

                $.ajax({
                    url: "action/applySem.php",
                    type: "POST",
                    data:  fd,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        alert("Application Success!");
                        window.location.href = "seminar.php";
                    },
                    error: function() 
                    {
                        alert("Error!");
                    }           
               });

                // console.log(mas);
            });

        });
    </script>

</body>

</html>
