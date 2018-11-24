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
                        Reports
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="reportsChair.php">
                                <i class="fa fa-pie-chart"></i> Reports
                            </a>
                        </li>
                        <li class="active">Must-Attend</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                  <div class="input-group">
                                      <input type="text" id="reports-title" class="form-control" autocomplete="off" autofocus>
                                      <div class="input-group-btn">
                                        <button class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <a class="btn btn-primary btnToggleSem">
                                            View All
                                        </a>
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>School</label>
                                  <select class="form-control" id="reports-school">
                                      <option>School of Technology</option>
                                      <option>School of Management</option>
                                      <option>School of Humanities</option>
                                      <option selected>All</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Academic Year</label>
                                  <select class="form-control" id="reports-ay">
                                      <option>2016-2017</option>
                                      <option>2015-2016</option>
                                      <option>2014-2015</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="reports-panel-title">
                                Overall
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- DEFAULT -->
                                <span id="overall">                                
                                <p class="col-sm-12">
                                    <a href="pdf/reports.php?type=perCollege" target="_blank" id="btn-genReports" class="btn btn-success">
                                        <i class="fa fa-file-pdf-o"></i>
                                        Generate Report
                                    </a>
                                </p>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="active">
                                                        <th class="col-sm-4">Seminar</th>
                                                        <th class="col-sm-3">Attendees</th>
                                                        <th class="col-sm-2">Percentage</th>
                                                        <th class="col-sm-3">(&#8369;) Budget</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="overallData">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </span>

                                <!-- SEARCH -->
                                <span id="search">
                                    <div class="col-sm-6">
                                        <canvas id="report-g-ma" width="200" height="150"></canvas>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <h4>
                                            <div class="row">
                                                <p>
                                                    <div class="col-sm-4">
                                                        <label>Seminar Title:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="search-title">
                                                    </div>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p>
                                                    <div class="col-sm-4">
                                                        <label>Attendees:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong class="text-danger" id="search-att">12</strong>/<span id="search-persons">14</span> <strong>(<span id="search-attPer"></span>%)</strong>
                                                    </div>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p>
                                                    <div class="col-sm-4">
                                                        <label>(&#8369;) Budget:</label>
                                                    </div>
                                                    <div class="col-sm-8" id="search-budget">
                                                        2, 500.00
                                                    </div>
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p><strong>Attendees</strong></p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <ul class="list-group" id="search-attendees">
                                                        <!-- <li class="list-group-item text-center">
                                                            <a href="javascript:void(0)">
                                                            Show more
                                                             <i class="fa fa-chevron-down"></i>
                                                            </a>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </h4>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <?php
        include('include/foot.php');
    ?>
    <!-- chartjs -->
    <script type="text/javascript" src="plugins/chart.js/dist/Chart.min.js"></script>
    <!-- typeahead -->
    <script type="text/javascript" src="plugins/typeahead/bootstrap3-typeahead.min.js"></script>
    <script>


    $(document).ready(function(){

        

        showOverall();
        $('.btnToggleSem').click(function(){
            // if($(this).hasClass('btn-primary')){
            //     $(this).removeClass('btn-primary').addClass('btn-default');
            // }else{
            //     $('#reports-panel-title').html('Overall');
            //     $(this).removeClass('btn-default').addClass('btn-primary');
            //     $('#reports-title-title').val('');
            // }
            $("#search").hide();
            showOverall();
        });

        $('#reports-ay').change(function(){
            showOverall();
        });

        $('#reports-school').change(function(){
            showOverall();
        });

        function showOverall(){
            $("#search").hide();
            var ay = $('#reports-ay').val();
            var school = $('#reports-school').val();

            if(school!="All"){
                $("#reports-panel-title").html(school);
            }else{
                $("#reports-panel-title").html("Overall");
            }
            $("#reports-title").val("");
            $("#maData").html('\
                <div class="col-sm-12 text-center">\
                    <i class="fa fa-spin fa-circle-o-notch fa-3x text-primary"></i>\
                </div>\
                ');
            $.get("action/reports.php",{ 
                action: "overallMa", 
                ay: ay,
                school: school
            }, function(data){
                $("#overall").show();
                $("#overallData").empty();
                if(data!=""){
                    var totalBudget = 0;
                    var nume = 0;
                    var deno = 0;
                    $.each(data, function(key){
                        var attPer = parseFloat(parseInt(data[key].attended)/parseInt(data[key].persons))*100;
                        totalBudget = parseFloat(data[key].budget)+parseFloat(totalBudget);
                        num = parseInt(data[key].attended)+parseInt(nume);
                        deno = parseInt(data[key].persons)+parseInt(deno);
                        // console.log(attPer);
                        $("#overallData").append('\
                            <tr>\
                                <td>'+data[key].title+'</td>\
                                <td>'+data[key].attended+'/'+data[key].persons+'</td>\
                                <td>'+attPer.toFixed(2)+'%</td>\
                                <td class="text-right">'+data[key].budget+'</td>\
                            </tr>\
                            ');
                    });

                    var totalPer = parseFloat((num/deno)*100);

                    $("#overallData").append('\
                        <tr>\
                            <td><strong>Total: </strong></td>\
                            <td></td>\
                            <td><h4><strong>'+totalPer.toFixed(2)+'%</h4></strong></td>\
                            <td class="text-right"><h4><strong>&#8369;'+totalBudget+'</strong></h4></td>\
                        <tr>\
                        ');

                    console.log(data);
                }else{
                    $("#overallData").html("No Records found in the database.");
                }
            });
        }

        //search
        $.get('action/reports.php', { action: 'suggestMa', ay: $('#reports-ay').val() } ,function(data){
            $('#reports-title').typeahead({
                source: data,
                afterSelect: function (titleData){
                    var title = $('#reports-title').val();
                    if(title!=""){
                        $('#reports-panel-title').html(titleData);
                        $.get('action/reports.php', { 
                            action: 'searchMa',
                            key: titleData,
                            ay: $('#reports-ay').val()
                        }, function(result){
                            
                            $("#search-title").html(result.title);
                            $("#search-att").html(result.attended);
                            $("#search-persons").html(result.persons);

                            var attPer = (result.attended/result.persons)*100;
                            $("#search-attPer").html(attPer.toFixed(2));
                            $("#search-budget").html(result.budget);

                            $("#search-attendees").empty();
                            if(result.attendees!=null){
                                $.each(result.attendees, function(key, val){
                                    var stat = '<i class="fa fa-check-circle text-success"></i></strong>';
                                    if(result.attendees[key].attended!='yes'){
                                        stat = '<i class="fa fa-times-circle text-danger"></i></strong>'
                                    }
                                    $("#search-attendees").append('\
                                        <li class="list-group-item">\
                                            <strong> '+result.attendees[key].fullname+' '+stat+'\
                                            <p class="list-group-item-text text-muted">\
                                                '+result.attendees[key].position+'\
                                            </p>\
                                        </li>\
                                        ');
                                });
                            }else{
                                $("#search-attendees").html("N/A");
                            }


                             var pieChartData = {
                                labels : ["Attended","Not Attended"],
                                datasets : [
                                  {
                                    label: 'Users by locations',
                                    backgroundColor: [
                                        '#2196f3',
                                        '#f44336',
                                    ],
                                    data : [result.attended,result.persons-result.attended]
                                  },
                                ]

                              };
                            var ctx = $("#report-g-ma");
                            var pie = new Chart(ctx, {
                              type: 'pie',
                              data: pieChartData,
                            });

                            // console.log(result);
                            $("#search").show();
                            $("#overall").hide();
                        });
                    }
                }
            });
        });

    });  
    </script>

</body>
</html>
