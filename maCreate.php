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
                        Must-Attend <small>Create New</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">
                                <i class="fa fa-book"></i> Manage
                            </a>
                        </li>
                        <li><a href="maList.php">Must-Attend</a></li>
                        <li class="active">Create New</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                        <h3 class="page-header">Details<input type="text" id="useremail" value="<?php
                        echo $email;
                        ?>" style="visibility:hidden;"></h3>
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
                                        <input type="text" id="ma-dateCreated" class="form-control" value="<?php echo date('M d, Y H:ia');?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <input type="text" id="ma-school" readonly class="form-control" value="<?php
                                        echo $school;
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" id="ma-department" readonly class="form-control" value="<?php
                                        echo $college;

                                        ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-header">Must-Attend Seminars</h3>
                            <div class="panel panel-default" data-count="1">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#c1">Must-Attend #1</a>
                                    </h4>
                                </div>
                                <div id="c1" class="panel-collapse collapse in ma">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control ma-title" name = "title">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
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
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Sponsoring Org</label>
                                                    <input type="text" class="form-control ma-sponsor"name = "sponsor">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="date" class="form-control ma-date" name = "datecreated">
													
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
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Venue</label>
                                                    <input type="text" class="form-control ma-venue" name = "venue">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Persons Involved</label>
                                                    <input type="text" class="form-control ma-persons">
                                                    <!-- autocomplete tags -->
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>No. of PAX</label>
                                                    <input type="text" class="form-control ma-pax">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                  <label>Estimated Budget</label>
                                                  <div class="input-group">
                                                      <div class="input-group-addon">&#8369;</div>
                                                      <input type="text" class="form-control ma-budget">
                                                      <div class="input-group-addon">.00</div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <span id="formMa"></span>
                        <a class="btn btn-primary btnAddFormMa">
                            <i class="fa fa-plus"></i>
                             New
                        </a>
                    </div>
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
                                    <p id="annualyear" class="col-sm-8 ma-revAy">
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Date Created: </strong>
                                    </p>
                                    <p id="datecreated" class="col-sm-9 ma-revDateCreated">
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
                                    <p id="schools" class="col-sm-8 ma-revSchool">
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Department: </strong>
                                    </p>
                                    <p id="departments" class="col-sm-9 ma-revDepartment">
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
                                        <th>No. Of PAX</th>
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
                    <a href="#" class="btn btn-primary btn-lg" onClick="confirmMustAttend()">Confirm</a>
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control ma-title">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control ma-category">
                                    <option value="Research">Research</option>
                                    <option value="Instructions">Instructions</option>
                                    <option value="FACE">FACE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Sponsoring Org</label>
                                <input type="text" class="form-control ma-sponsor">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control ma-date">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>No. of Days</label>
                                <select class="form-control ma-days">
                                    <option >1</option>
                                    <option >2</option>
                                    <option >3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Venue</label>
                                <input type="text" class="form-control ma-venue">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Persons Involved</label>
                                <input type="text" class="form-control ma-persons">
                                <!-- autocomplete tags -->
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>No. of PAX</label>
                                <input type="text" class="form-control ma-pax">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Estimated Budget</label>
                              <div class="input-group">
                                  <div class="input-group-addon">&#8369;</div>
                                  <input type="text" class="form-control ma-budget">
                                  <div class="input-group-addon">.00</div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
     var  num=0;
        $(function(){

            $('#btnSubmitMA').click(function(){
                var ay = $('#ma-ay').val();
                var dateCreated = $('#ma-dateCreated').val();
                var school = $('#ma-school').val();
                var department = $('#ma-department').val();
                 num=0;
                var ma = [];
                $('.ma').each(function(){
                    var eachMa =
                        {
                            title: $(this).find('.ma-title').val(),
                            category: $(this).find('.ma-category').val(),
                            sponsor: $(this).find('.ma-sponsor').val(),
                            date: $(this).find('.ma-date').val(),
                            days: $(this).find('.ma-days').val(),
                            venue: $(this).find('.ma-venue').val(),
                            persons: $(this).find('.ma-persons').val(),
                            pax: $(this).find('.ma-pax').val(),
                            budget: $(this).find('.ma-budget').val(),
                        };

                    ma.push(eachMa);
                });

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

                $('#maEach').html('');
               
                $.each(ma, function(key, val){
                    num+=1;
                    $('#maEach').append('\
                        <tr>\
                            <td id="title'+num+'">'+ma[key].title+'</td>\
                            <td id="category'+num+'">'+ma[key].category+'</td>\
                            <td id="sponsor'+num+'">'+ma[key].sponsor+'</td>\
                            <td id="date'+num+'">'+ma[key].date+'</td>\
                            <td id="days'+num+'">'+ma[key].days+'</td>\
                            <td  id="venue'+num+'">'+ma[key].venue+'</td>\
                            <td id="person'+num+'">'+ma[key].persons+'</td>\
                            <td id="pax'+num+'">'+ma[key].pax+'</td>\
                            <td id="budget'+num+'">'+ma[key].budget+'</td>\
                        </tr>\
                        ');
                });

                console.log(mas);

            });

            var c = 1;
            $('.btnAddFormMa').click(function(){
                c += 1;
                $('#maForm').find('.panel').attr('data-count', c);
                $('#maForm').find('a').prop('href','#c'+c).html('Must-Attend #'+c);
                $('#maForm').find('.panel-collapse').prop('id','c'+c).addClass('ma');
                $('#formMa').append($('#maForm').html());
                $('#maForm').find('.panel-collapse').removeClass('ma');
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

        });

        function confirmMustAttend(){
            var counts=0;
        for( var x=1;x<=num;x++){
            var title = document.getElementById ( "title"+x ).innerText;
            var category = document.getElementById ( "category"+x ).innerText;
            var sponsor= document.getElementById ( "sponsor"+x ).innerText;
            var dates = document.getElementById ( "date"+x ).innerText;
            var days = document.getElementById ( "days"+x ).innerText;
             var venue = document.getElementById ( "venue"+x ).innerText;
             var person = document.getElementById ( "person"+x ).innerText;
             var pax = document.getElementById ( "pax"+x ).innerText;
             var budget = document.getElementById ( "budget"+x ).innerText;
             var ay=document.getElementById('annualyear').innerText;
            var datecreated=document.getElementById('datecreated').innerText;
            var departments=document.getElementById('departments').innerText;
            var schools=document.getElementById('schools').innerText;
            var useremail=document.getElementById('useremail').value;
            var xmlhttp = new XMLHttpRequest();
            var ip ="http://efsdp.icodeforu.com/db/";
               var url = ip+"db_createmustAttend.php";
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                 xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var data = JSON.parse(xmlhttp.responseText);
                    alert(data.notification);
                        // if(data.notification=="Your review  is successfully submitted"){
                        //     // window.open("loadDisplayPost.html","_self");
                        // }else if(data.notification=="Your already review this post"){
                        //     // window.open("loadDisplayPost.html","_self");
                        // }else{

                        // }
                    }
                  }

                      xmlhttp.send("ay="+ ay +"&"+"datecreated=" + datecreated+"&"+"departments=" + departments+"&"+"schools=" + schools+"&"+"useremail=" + useremail+"&"+"title="+title+"&"+"category="+category+"&"+"sponsor="+sponsor+"&"+"dates="+dates+"&"+"venue="+venue+"&"+"person="+person+"&"+"pax="+pax+"&"+"budget="+budget+"&"+"days="+days);

           
            //      alert( document.getElementById ( "title"+x ).innerText);
            }
          
        }
    </script>
</body>

</html>
