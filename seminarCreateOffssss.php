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
                                              <input type="text" class="form-control" value="Jennylynn Palma" id="sem-empName" readonly>
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
                                            <input type="text" class="form-control" id="sem-position" value="IT Fulltime Faculty" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control" id="sem-department" value="CCIT" readonly>
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
                                                <select id="sem-semName" class="form-control selectpicker show-tick" data-live-search="true" title="Select Seminar...">
                                                    <option value="1">PSITE Regional Conference (Feb & Sept)</option>
                                                    <option value="2">PSITE National Conference (NATCON)</option>
                                                    <option value="3">NCITE</option>
                                                    <option value="4">CSP Convention</option>
                                                </select>
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
                                        
                                        <div class="form-group">
                                            <label class="control-label">Invitation/Supporting Documents</label>
                                            <input type="file" class="form-control" multiple>
                                            <p class="help-block">You can select more than one file.</p>
                                        </div>
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
                                                        <label>Sponsoring Org.:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        PSITE IV-A
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Venue:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        Region IV
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Date:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <i>Next week</i> at Jan. 13, 2016
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>No. of Days: </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        1
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p><strong>8</strong> persons will be joining this seminar including:</p>
                                                        <p class="text-center"><strong>Heads,Faculty,Staffs</strong></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <strong>Faculty Name 1</strong>
                                                                <p class="list-group-item-text text-muted">
                                                                    Position
                                                                </p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Faculty Name 1</strong>
                                                                <p class="list-group-item-text text-muted">
                                                                    Position
                                                                </p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Staff Name 1</strong>
                                                                <p class="list-group-item-text text-muted">
                                                                    Position
                                                                </p>
                                                            </li>
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
                                                        <h4>P 1,500.00</h4>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <strong>Total Budget Requirement</strong>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <h4>P 5,500.00</h4>
                                                        <!-- <a href="javascript:void(0)">
                                                            <i class="fa fa-plus"></i>
                                                             More details
                                                        </a> -->
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
                                        <strong>Employee Name: </strong>
                                    </p>
                                    <p class="col-sm-7">
                                        Jennylynn Palma 
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>Date Created: </strong>
                                    </p>
                                    <p class="col-sm-8">
                                        Dec 23,2016 07:47pm 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-5">
                                        <strong>Position: </strong>
                                    </p>
                                    <p class="col-sm-7">
                                        IT Fulltime Faculty
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-4">
                                        <strong>Department: </strong>
                                    </p>
                                    <p class="col-sm-8">
                                        CCIT
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Seminar Details
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Title: </label>
                                        A random off-campus training/seminar
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date: </label>
                                            Jan 23, 2017
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Place/Venue: </label>
                                            Batangas, Philippines
                                        </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>No. of Days: </label>
                                            3
                                        </div>
                                    </form>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Echo Schedule: </label>
                                            Jan. 23, 2017 - Jan. 26, 2017
                                        </div>
                                    </form>
                                  </div>
                                </div>

                                <hr>

                                <div class="row">
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
                                            <p>
                                                A random excuse to fill this form slightly. Feel free to add more.
                                            </p>
                                        </div>
                                    </form>
                                  </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Your Budget</div>
                                        <span class="text-center">
                                            <h4>&#8369;800.00</h4>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Total Budget</div>
                                        <span class="text-center">
                                            <h4>&#8369;15, 000.00</h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-default btn-block">For submission <i class="fa fa-send-o"></i></a>
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
