<?php
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
                        Seminars <small>Create New</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="seminar.php">Seminars</a></li>
                        <li class="active">Off-Campus</li>
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Date Created</label>
                                            <input type="text" class="form-control" id="sem-dateCreated" value="<?php echo date('M d, Y H:ia'); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Position</label>
                                            <input type="text" class="form-control" id="sem-position" value="<?php echo $accPos; ?>" readonly>
                                        </div>
                                    </div>
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
                                        <div class="form-group">
                                            <label class="control-label">Title of Seminar</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="sem-semName" autofocus>
                                                <div class="input-group-btn">
                                                    <a class="btn btn-primary btnToggleSem">
                                                        MA
                                                    </a>
                                                    <a class="btn btn-primary btnToggleSem">
                                                        TNA
                                                    </a>
                                                    <a class="btn btn-primary btnToggleSem">
                                                        Others
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Echo Schedule</label>
                                                    <input type="date" class="form-control sem-echoSched">
                                                </div>
                                            </div>
                                            <span id="echoSched"></span>
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    <a class="btn btn-primary btnAddEcho">
                                                    <i class="fa fa-plus"></i>
                                                     Add
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="form-group">
                                            <label class="control-label">Invitation/Supporting Documents</label>
                                            <input type="file" class="form-control" multiple>
                                            <p class="help-block">You can select more than one file.</p>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label">Reasons for Attending</label>
                                            <textarea rows="5" id="sem-reasons" class="form-control"></textarea>
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
                                                        <label>Academic Year:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-ay">
                                                        N/A
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Sponsoring Org.:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-sponsor">
                                                        N/A
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Venue:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-venue">
                                                        N/A
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Date:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-date">
                                                        <!-- <i>Next week</i> at Jan. 13, 2016 -->
                                                        N/A
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>No. of Days: </label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-days">
                                                        N/A
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p><strong id="sem-persons">No</strong> persons will be attending this seminar including:</p>
                                                        <p class="text-center"><strong id="sem-includes">N/A</strong></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <ul class="list-group">
                                                            <span id="sem-attendees"></span>
                                                            <li class="list-group-item text-center">
                                                                <a href="javascript:void(0)">
                                                                Show more
                                                                 <i class="fa fa-chevron-down"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <strong>Your Budget</strong>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <h4 id="sem-yourBudget">1,500.00</h4>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <strong>Total Budget Requirement</strong>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <h4 id="sem-totalBudget">5,500.00</h4>
                                                        <a href="javascript:void(0)">
                                                            <i class="fa fa-plus"></i>
                                                             More details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pull-right text-right">
                                <a data-toggle="modal" data-target="#reviewSeminar" class="btn btn-primary btn-lg">
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
                                            PSITE National Conference (NATCON)
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <p class="col-sm-3">
                                            <strong>Category: </strong>
                                        </p>
                                        <p class="col-sm-9" id="rev-semCategory">
                                            Research
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
                                            PSITE Nat'l
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <p class="col-sm-3">
                                            <strong>Venue: </strong>
                                        </p>
                                        <p class="col-sm-9" id="rev-semVenue">
                                            Philippines
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
                                                    <li class="list-group-item">
                                                        <u class="text-primary">
                                                            sample-invitation.jpg
                                                        </u>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <u class="text-primary">
                                                            random-docs.docx
                                                        </u>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <u class="text-primary">
                                                            sample-invitation(random).png
                                                        </u>
                                                    </li>
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
                                            <p><strong>8</strong> persons will be joining this seminar including: <strong>Heads,Faculty and Staffs</strong></p>
                                            <div class="list-group">
                                                <a href="#" class="list-group-item">
                                                    <strong>Rodrigo Duterte</strong>
                                                    <p class="list-group-item-text text-muted">President of the Philippines</p>
                                                </a>
                                                <a href="#" class="list-group-item">
                                                    <strong>Nancy Robredo</strong>
                                                    <p class="list-group-item-text text-muted">Vice President of the Philippines</p>
                                                </a>
                                                <a href="#" class="list-group-item">
                                                    <strong>CCIT (College of Computing in Information Technology)</strong>
                                                    <p class="list-group-item-text text-muted">College Department</p>
                                                </a>
                                            </div>
                                           <!--  <button id="showAllPerson" class="btn btn-default btn-block" style="">
                                                <i class="fa fa-chevron-down"></i>
                                            </button> -->
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
                                                    <p class="col-sm-6">
                                                        Jan. 02, 2017
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-6">
                                                        <strong>Number of Days: </strong>
                                                    </p>
                                                    <p class="col-sm-6">
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
                                                    <h4>&#8369;15, 100.00</h4>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                <hr>
                                                    <strong>Your Budget</strong>
                                                    <h4>&#8369;800.00</h4>
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
                    <a href="seminar.php" class="btn btn-primary btn-lg">Confirm</a>
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
                <input type="date"  class="form-control">
            </div>
        </div>
    </script>
    
    <script>
        $(function(){

            $.get('action/loadAllMa.php', { action: 'suggest' } ,function(data){
                $('#sem-semName').typeahead({
                    source: data,
                    afterSelect: function(){
                        loadMa();
                    }
                });
            });

            function loadMa(){
                var semTitle = $('#sem-semName').val();
                $.get('action/loadAllMa.php', { action: 'find', title: semTitle } ,function(data){
                    if(data!="empty"){
                        $("#sem-attendees").empty();
                        $("#sem-ay").html(data.academicyear);
                        $("#sem-sponsor").html(data.sponsor);
                        $("#sem-venue").html(data.venue);
                        $("#sem-date").html(data.dates);
                        $("#sem-days").html(data.numdays);
                        $("#sem-persons").html(data.persons);
                        $("#sem-includes").html(data.includes);
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

            $('.btnToggleSem').click(function(){
                if($(this).hasClass('btn-primary')){
                    $(this).removeClass('btn-primary').addClass('btn-default');
                }else{
                    $(this).removeClass('btn-default').addClass('btn-primary');
                }
            });

        });
    </script>

</body>

</html>
