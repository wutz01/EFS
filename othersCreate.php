<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>
<?php
    include("action/session-auth.php");
    include("include/head.php");
?>

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
                        Others <small>Create New</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="others.php">Others</a></li>
                        <li class="active">Create New</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-header">Employee Details</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Name</label>
                                  <input type="text" id="fullname" class="form-control" value="<?php 
                                    echo ucwords(strtolower($firstname));
                                    echo " ";
                                    echo ucwords(strtolower($middlename[0])).". ";
                                    echo ucwords(strtolower($lastname));
                                   ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date Created</label>
                                <input type="text" id="datecreated" class="form-control" value="<?php echo date('M d, Y H:ia'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Position</label>
                                <input type="text" id="position" class="form-control" value="<?php
                                     echo ucwords(strtolower($logUser));

                                ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Department</label>
                                <input type="text" id="college" class="form-control" value="<?php
                                     echo strtoupper($college);
                                ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                
                                <input type="hidden" id="email" class="form-control" value="<?php
                                     echo $email;
                                ?>" readonly >
                            </div>
                        </div>
                    </div>
                <h3 class="page-header">Seminar Details</h3>
                </div>

                <div class="ma">
                    <!-- Details -->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control ma-title">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Echo Schedule</label>
                                    <input type="date" class="form-control echoSched">
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Invitation/Supporting Documents</label>
                                    <input type="file" class="form-control" multiple>
                                    <p class="help-block">You can select more than one file.</p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Reasons for Attending</label>
                                    <textarea rows="5" class="form-control reasons"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Budget -->
                    <div class="col-sm-12">
                        <h4 class="page-header"><strong>Budget Requirements</strong></h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="active">
                                                <th class="col-sm-1">Position</th>
                                                <th class="col-sm-1">Quantity</th>
                                                <th class="col-sm-1">(&#8369;) Hotel Accommodation <span class="text-muted">x Days</span></th>
                                                <th class="col-sm-1">(&#8369;) Per Diem <span class="text-muted">x Days</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dean</td>
                                                <td><input type="number" class="form-control ma-deanQty"></td>
                                                <td><input type="text" class="form-control ma-deanHotel" value="0" disabled></td>
                                                <td><input type="text" class="form-control ma-deanDiem" value="0" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Chair</td>
                                                <td><input type="number" class="form-control ma-chairQty"></td>
                                                <td><input type="text" class="form-control ma-chairHotel" value="0" disabled></td>
                                                <td><input type="text" class="form-control ma-chairDiem" value="0" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Faculty</td>
                                                <td><input type="number" class="form-control ma-facQty"></td>
                                                <td><input type="text" class="form-control ma-facHotel" value="0" disabled></td>
                                                <td><input type="text" class="form-control ma-facDiem" value="0" disabled></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="text-right"><h4 class="ma-pax"></h4></td>
                                                <td class="text-right"><h4 class="hotelTotal"></h4></td>
                                                <td class="text-right"><h4 class="diemTotal"></h4></td>
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
                    </div>
                    
                    <!-- Budget 2-->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Registration Fee</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">&#8369;</div>
                                        <input type="number" class="form-control ma-regFee">
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
                                        <input type="number" class="form-control ma-transFee">
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
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 pull-right text-right">
                    <a data-toggle="modal" data-target="#reviewOthers" id="btnSubmitOther" class="btn btn-primary btn-lg">
                        Submit 
                        <i class="fa fa-send"></i>
                    </a>
                </div>
            </div>

    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Seminar Modal -->
    <div class="modal fade" id="reviewOthers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <p class="col-sm-7" id="rev-title">
                                        
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Category: </strong>
                                    </p>
                                    <p class="col-sm-9" id="rev-category">
                                        
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
                                    <p class="col-sm-7" id="rev-sponsor">
                                        
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Venue: </strong>
                                    </p>
                                    <p class="col-sm-9" id="rev-venue">
                                        
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
                                            <p id="rev-reasons">
                                            </p>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Echo Schedule: </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p id="rev-echo"></p>
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
                                        <p><strong id="rev-persons">No</strong> persons will be joining this seminar including: <strong id="rev-includes"></strong></p> 
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
                                                    
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-6">
                                                    <strong>Number of Days: </strong>
                                                </p>
                                                <p class="col-sm-6" id="rev-days">
                                                    
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
                                                <strong>(&#8369;) Total Budget Requirement</strong>
                                                <h4 id="rev-totalBudget"></h4>
                                            </div>
                                            <div class="col-sm-12 text-center">
                                            <hr>
                                                <strong>(&#8369;) Your Budget</strong>
                                                <h4 id="rev-yourBudget"></h4>
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
                    <a class="btn btn-primary btn-lg btnConfirmOther">Confirm</a>
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
                <input type="date"  class="form-control echoSched">
            </div>
        </div>
    </script>

    <script>
        $(function(){

            var deanH = 1000; //dean hotel
            var deanD = 800; // dean diem
            var chairH = 800; //chair hotel
            var chairD = 500; //chair diem
            var facH = 500; //faculty hotel
            var facD = 300; //faculty hotel

            var elemToRemove = "";

            $('#btnSubmitOther').click(function(){
                var fullName = $('#fullname').val();
                var dateCreated = $('#datecreated').val();
                var position = $('#position').val();
                var college = $('#college').val();
                var email = $('#email').val();
                            

                var echoSched = [];
                $('.echoSched').each(function(){
                    var eachEcho = $(this).val();
                    echoSched.push(eachEcho);
                });

                if($('.ma-otherFee').length!=0){
                    var otherFee = [];
                    $('.ma-otherFee').each(function(){
                        var eachOther = {
                            title: $(this).data('title'),
                            value: $(this).val()
                        };

                        otherFee.push(eachOther);
                    });
                }else{
                    var otherFee = "";
                }

                var otherSem = 
                    {   
                        email: email,
                        dateCreated: dateCreated,
                        title: $('.ma-title').val(),
                        category: $('.ma-category').val(),
                        sponsor: $('.ma-sponsor').val(),
                        date: $('.ma-date').val(),
                        days: $('.ma-days').val(),
                        persons: $('.ma-pax').html(),
                        venue: $('.ma-venue').val(),
                        reasons: $('.reasons').val(),
                        echoSched: echoSched,
                        numDean: $('.ma-deanQty').val(),
                        deanHotel: $('.ma-deanHotel').val(),
                        deanDiem: $('.ma-deanDiem').val(),
                        numChair: $('.ma-chairQty').val(),
                        chairHotel: $('.ma-chairHotel').val(),
                        chairDiem: $('.ma-chairDiem').val(),
                        numFac: $('.ma-facQty').val(),
                        facHotel: $('.ma-facHotel').val(),
                        facDiem: $('.ma-facDiem').val(),
                        regFee: $('.ma-regFee').val(),
                        foodFee: $('.ma-foodFee').val(),
                        transFee: $('.ma-transFee').val(),
                        otherFee: otherFee,
                        budget: $('.ma-budgetTotal').html(),
                    };


                //review
                $('#rev-title').html(otherSem.title);
                $('#rev-category').html(otherSem.category);
                $('#rev-sponsor').html(otherSem.sponsor);
                $('#rev-venue').html(otherSem.venue);
                $('#rev-reasons').html(otherSem.reasons);
                $('#rev-persons').html(otherSem.persons);
                $('#rev-date').html(otherSem.date);
                $('#rev-days').html(otherSem.days);
                $('#rev-days').html(otherSem.days);

                console.log(otherSem);
                localStorage.otherSem = JSON.stringify(otherSem);
            });

            $('.btnConfirmOther').click(function(){
                var otherSem = JSON.parse(localStorage.otherSem);
                console.log(otherSem);
                $.get('action/addOtherSem.php',{ data: otherSem }, function(response){
                    console.log(response);
                    window.location.href = "others.php";
                });
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
                                <input type="text" class="form-control titleOther" placeholder="Others Fee Title">\
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
                $(this).closest('.ma').find('.days').html($(this).val());
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

            $(document).on('click', '.btnRemoveMa', function(){
                elemToRemove = $(this).closest('.panel').data('count');
            });


            $("#btnRemoveYes").click(function(){
                var dataElem = $('[data-count="'+elemToRemove+'"]');
                dataElem.remove();
                elemToRemove = "";
            });

            $("#btnRemoveNo").click(function(){
                elemToRemove = "";
            });
            

            $('.btnAddEcho').click(function(){
                $('#echoSched').append($('#echoTemp').html());
            });


        });
    </script>
</body>

</html>
