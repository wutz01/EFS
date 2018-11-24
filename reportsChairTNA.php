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
                        <li class="active">TNA</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Faculty Name</label>
                                  <div class="input-group">
                                      <input type="text" id="reports-fac" class="form-control" autocomplete="off" autofocus>
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
                                      <option>All</option>
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
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="active">
                                                        <th class="col-sm-4">Faculty</th>
                                                        <th class="col-sm-4">Position</th>
                                                        <th class="col-sm-3">Job Roles Completed</th>
                                                        <th class="col-sm-2">Percentage</th>
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
                                        <canvas id="report-g-ma" width="80" height="50"></canvas>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <p>
                                                <div class="col-sm-5">
                                                    <label>Position:</label>
                                                </div>
                                                <div class="col-sm-7" id="search-position">
                                                </div>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <p>
                                                <div class="col-sm-5">
                                                    <label>Department:</label>
                                                </div>
                                                <div class="col-sm-7" id="search-department">
                                                </div>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <p>
                                                <div class="col-sm-5">
                                                    <label>Job Roles Completed:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong><span id="search-completed"></span>/<span id="search-jobroles"></span></strong>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <p>
                                                <div class="col-sm-5">
                                                    <label>Percentage:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                <span id="search-percentage"></span>%
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr class="active">
                                                                <th class="col-sm-3">Job Roles</th>
                                                                <th class="col-sm-2">Importance</th>
                                                                <th class="col-sm-2">Ability</th>
                                                                <th class="col-sm-2">Competency</th>
                                                                <th class="col-sm-2">Dev. Plan</th>
                                                                <th class="col-sm-2">Post-activity Documents</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="searchData">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
            $("#search").hide();
            showOverall();
        });

        $('#reports-ay').change(function(){
            showOverall();
        });

        function showOverall(){
            $("#search").hide();
            $("#reports-panel-title").html("Overall");
            $("#reports-fac").val("");
            $("#maData").html('\
                <div class="col-sm-12 text-center">\
                    <i class="fa fa-spin fa-circle-o-notch fa-3x text-primary"></i>\
                </div>\
                ');
            $.get("action/reports.php",{ action: "overallTNA", ay: $('#reports-ay').val() }, function(data){
                $("#overall").show();
                $("#overallData").empty();
                if(data!=""){
                    var nume = 0;
                    var deno = 0;
                    $.each(data, function(key){
                        var jrcPer = parseFloat(parseInt(data[key].completed)/parseInt(data[key].jobroles))*100;
                        num = parseInt(data[key].completed)+parseInt(nume);
                        deno = parseInt(data[key].jobroles)+parseInt(deno);
                        console.log(jrcPer);
                        $("#overallData").append('\
                            <tr>\
                                <td>'+data[key].fullname+'</td>\
                                <td>'+data[key].position+'</td>\
                                <td>'+data[key].completed+'/'+data[key].jobroles+'</td>\
                                <td class="text-right">'+jrcPer.toFixed(2)+'%</td>\
                            </tr>\
                            ');
                    });

                    var totalPer = parseFloat((num/deno)*100);

                    $("#overallData").append('\
                        <tr>\
                            <td><h4><strong>Total: </h4></strong></td>\
                            <td></td>\
                            <td></td>\
                            <td><h4><strong>'+totalPer.toFixed(2)+'%</h4></strong></td>\
                        <tr>\
                        ');

                    console.log(data);
                }else{
                    $("#overallData").html("No Records found in the database.");
                }
            });
        }

        //search
        $.get('action/reports.php', { action: 'suggestTNA', ay: $('#reports-ay').val() } ,function(data){
            $('#reports-fac').typeahead({
                source: data,
                afterSelect: function (fac){
                    var title = $('#reports-title').val();
                    if(title!=""){
                        $('#reports-panel-title').html(fac.name);
                        $.get('action/reports.php', { 
                            action: 'searchTNA',
                            key: fac.email,
                            ay: $('#reports-ay').val()
                        }, function(result){
                            var percentage = (parseFloat(result.completed)/parseFloat(result.jobroles))*100;
                            $("#search-position").html(result.position);
                            $("#search-department").html(result.department);
                            $("#search-completed").html(result.completed);
                            $("#search-jobroles").html(result.jobroles);
                            $("#search-percentage").html(percentage.toFixed(2));

                            $("#searchData").empty();
                            if(result.jrc!=null){
                                $.each(result.jrc, function(key, val){
                                    $("#searchData").append('\
                                        <tr>\
                                            <td>'+result.jrc[key].title+'</td>\
                                            <td>'+result.jrc[key].position+'</td>\
                                            <td>'+result.jrc[key].ability+'</td>\
                                            <td>'+result.jrc[key].competency+'</td>\
                                            <td>'+result.jrc[key].devplan+'</td>\
                                            <td>'+result.jrc[key].evidence+'</td>\
                                        </tr>\
                                        ');
                                });
                            }else{
                                $("#searchData").html("N/A");
                            }


                             var pieChartData = {
                                labels : ["Completed","Remaining"],
                                datasets : [
                                  {
                                    label: 'Users by locations',
                                    backgroundColor: [
                                        '#2196f3',
                                        '#f44336',
                                    ],
                                    data : [result.completed,result.jobroles-result.completed]
                                  },
                                ]

                              };
                            var ctx = $("#report-g-ma");
                            var pie = new Chart(ctx, {
                              type: 'pie',
                              data: pieChartData,
                              options: {
                                title: {
                                    display: true,
                                    text: 'Job Roles Compentencies'
                                },
                              }
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
