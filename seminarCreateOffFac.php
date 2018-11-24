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
                                <h3 class="page-header">Employee Details <input type="text" style="visibility:hidden;" id="applicant" value="<?php echo $email;?>"><input type="text" style="visibility:hidden;" id="usertype" value="<?php echo $logUser;?>"></h3>
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
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="control-label">Title of Seminar</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control " id="sem-semName" autofocus>
                                                        <div class="input-group-btn">
                                                            <a class="btn btn-primary" onClick="searchSeminar()">
                                                                 <i class="fa fa-search"></i>
                                                            </a>
                                                            <!-- <a class="btn btn-primary btnToggleSem">
                                                                TNA
                                                            </a> -->
                                                            <!-- <a class="btn btn-primary btnToggleSem" id="btnOthers" data-status="on">
                                                                Others
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="sem-semId">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                 <div class="form-group">
                                                    <label for="">Category</label>
                                                    <select class="form-control " id="sem-categorys">
                                                        <option value="Must-Attend">Must-Attend Seminar</option>
                                                        <option value="TNA">Training Needs Analysis</option>
                                    
                                                    </select>
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
                                                        <label>Category.:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="sem-category">
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
                                                        <h4 id="sem-yourBudget"></h4>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <strong>Total Budget Requirement</strong>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <h4 id="sem-totalBudget"></h4>
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
                    <h4 class="modal-title" id="myModalLabel">Seminar<input type="text" id="masids" style="visibility:hidden;"></h4>
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
                                            <p><strong id="rev-persons">8</strong> persons will be joining this seminar including: <strong id="rev-includes">Heads,Faculty and Staffs</strong></p>
                                            <div class="list-group">
                                                <span id="rev-attendees"></span>
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
                                                    <h4 id="rev-totalBudget"></h4>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                <hr>
                                                    <strong>Your Budget</strong>
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
                    <a class="btn btn-primary btn-lg"  onClick="sendApplication()">Confirm</a>
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

            var semType = "all";
            checkFilter();

            $.get('action/loadAllMa.php', { action: 'suggest' } ,function(data){
                $('#sem-semName').typeahead({
                    source: data,
                    afterSelect: function(){
                        loadMa();
                    }
                });
            });

            function loadMa(){
                // var semTitle = $('#sem-semName').val();
                // $.get('action/loadAllMa.php', { action: 'find', title: semTitle } ,function(data){
                //     if(data!="empty"){
                //         $("#sem-attendees").empty();
                //         $("#sem-semId").val(data.masid);
                //         $("#sem-ay").html(data.academicyear);
                //         $("#sem-category").html(data.category);
                //         $("#sem-sponsor").html(data.sponsor);
                //         $("#sem-venue").html(data.venue);
                //         $("#sem-date").html(data.dates);
                //         $("#sem-days").html(data.numdays);
                //         $("#sem-persons").html(data.persons);
                //         $("#sem-includes").html(data.includes);
                //         $.each(data.attendees, function(key, val){
                //             $("#sem-attendees").append('\
                //                 <li class="list-group-item">\
                //                     <strong>'+data.attendees[key].firstname+' '+data.attendees[key].lastname+'</strong>\
                //                     <p class="list-group-item-text text-muted">\
                //                         '+data.attendees[key].position+'\
                //                     </p>\
                //                 </li>\
                //                 ');
                //         });
                //     }else{
                //         $("#sem-ay").html("N/A");
                //         $("#sem-sponsor").html("N/A");
                //         $("#sem-venue").html("N/A");
                //         $("#sem-date").html("N/A");
                //         $("#sem-days").html("N/A");
                //     }
                // });
            }

            $('.btnAddEcho').click(function(){
                $('#echoSched').append($('#echoTemp').html());
            });

            $('.btnToggleSem').click(function(){
                if($(this).hasClass('btn-primary')){
                    $(this).removeClass('btn-primary').addClass('btn-default');
                    $(this).data('status','off');
                }else{
                    $(this).removeClass('btn-default').addClass('btn-primary');
                    $(this).data('status','on');
                }
                
                checkFilter();
            });

            function checkFilter(){
                var mas = $('#btnMas').data('status');
                var others = $('#btnOthers').data('status');
                if((mas=="on")&&(others=="on")){
                    semType = "all";
                }else if((mas=="on")&&(others=="off")){
                    semType = "mas";
                }else if((mas=="off")&&(others=="on")){
                    semType = "others";
                }

                console.log(semType);
            }

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
                $("#rev-date").html($("#sem-date"));
                $("#rev-days").html($("#sem-days"));
                $("#rev-totalBudget").html($("#sem-totalBudget"));
                $("#rev-yourBudget").html($("#sem-yourBudget"));

            });

            $("#btnConfirm").click(function(){
                var masid = $("#sem-semId").val();
                var email = $("#sem-email").val();
                var echoSched = [];
                $(".sem-echoSched").each(function(){
                   echoSched.push($(this).val());
                });
                var docs = "PENDING";
                var reasons = $("#sem-reasons").val();

                var mas = {
                    "masid": masid,
                    "email": email,
                    "echoSched": echoSched,
                    "docs": docs,
                    "reasons": reasons
                };
                $.get("action/add.php",{ 
                    action: "seminar",
                    value: mas
                },function(data){
                    alert("Application Success!");
                    window.location.href = "seminar.php";
                });
                // console.log(mas);
            });

        });

    function searchSeminar(){
        var title =document.getElementById('sem-semName').value;
        var masid;
        // document.getElementById('tna-email').value = name;
        var xmlhttp = new XMLHttpRequest();
            var ip ="http://localhost/efsdp/db/";
               var url = ip+"db_searchSeminar.php";
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      var result = JSON.parse(xmlhttp.responseText);
                   
                        for(var obj in result){
                            // var position =result[obj].designation;
                            // var department = result[obj].college;
                            // document.getElementById('tna-position').value=position.toUpperCase();
                            // document.getElementById('tna-department').value=department.toUpperCase();
                            document.getElementById('sem-ay').innerHTML=result[obj].academicyear;
                            document.getElementById('sem-category').innerHTML=result[obj].category;
                            document.getElementById('sem-sponsor').innerHTML=result[obj].sponsor;
                            document.getElementById('sem-date').innerHTML=result[obj].dates;
                            document.getElementById('sem-venue').innerHTML=result[obj].venue;
                            document.getElementById('sem-days').innerHTML=result[obj].numdays;
                             document.getElementById('sem-totalBudget').innerHTML=result[obj].budget;
                            masid = result[obj].masid;
                            // document.getElementById('tna-email').value=result[obj].email;
                            document.getElementById('masids').value=masid;
                        }
                        searchBudget(masid); 
                    }

                  }

                      xmlhttp.send("title="+ title);
    }
    function searchBudget(masid){
       
        var applicant =document.getElementById('applicant').value;
        var usertype =document.getElementById('usertype').value;
        // alert(usertype);
        // // document.getElementById('tna-email').value = name;
        var xmlhttp = new XMLHttpRequest();
            var ip ="http://localhost/efsdp/db/";
               var url = ip+"db_searchBudget.php";
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      var result = JSON.parse(xmlhttp.responseText);
                   
                        for(var obj in result){
                             document.getElementById('sem-yourBudget').innerHTML=result[obj].budget;

                        }
                        
                    }
                  }

                      xmlhttp.send("masid="+ masid+"&"+"email=" + applicant+"&"+"usertype=" + usertype);
    }
    function sendApplication(){
            
            var email=document.getElementById("applicant").value;
            var masids = document.getElementById('masids').value;
            var reasons = document.getElementById('sem-reasons').value;
            var e = document.getElementById("sem-categorys");
            var category = e.options[e.selectedIndex].value;
            // var category = document.getElementById('sem-category').value;
          
            var xmlhttp = new XMLHttpRequest();
            var ip ="http://localhost/efsdp/db/";
               var url = ip+"db_applySeminar.php";
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 xmlhttp.onreadystatechange=function() {

                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var data = JSON.parse(xmlhttp.responseText);
                     
                       if(data.notification=="1"){
                        alert("Successfully submit your application");
                        window.open("seminar.php","_self");
                       }else if(data.notification=="2"){
                        alert("You already apply  for this seminar");
                       }else if(data.notification=="3"){
                        alert("Don not leave form blank");
                       }  
                    }


                  }

                      xmlhttp.send("email="+ email +"&"+"masids=" + masids+"&"+"reasons=" + reasons+"&"+"category=" + category);
                   
            //  counts++;
            
            // if(counts==count){
            //     alert("Successfully added new must attend seminar");
            //     window.open("maList.php","_self");
               
            // }
         

           
   
        }
    </script>

</body>

</html>
