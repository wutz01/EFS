<?php
    include("include/head-acadhead.php");
?>
<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Acadhead</title>


<body>

    <div id="wrapper">

<?php
    include("include/nav-acadhead.php");
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
                        <li><a href="mustAttend.php">Must-Attend</a></li>
                        <li><a >PSITE National Conference (NATCON)</a></li>
                        <li class="active">Edit</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">
                    <form action="" role="form">
                    
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" value="PSITE National Conference (NATCON)">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Research</option>
                                        <option value="">Instructions</option>
                                        <option value="">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Sponsoring Org</label>
                                    <input type="text" class="form-control" value="PSITE Nat'l">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Venue</label>
                                    <input type="text" class="form-control" value="Philippines">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Estimated Date</label>
                                    <!-- <input type="text" class="form-control"> -->
                                    <input type="date" class="form-control" value="2017-01-02">
                                   <!--  <select name="" id="" class="form-control">
                                        <option value="">January</option>
                                        <option value="">February</option>
                                        <option value="">March</option>
                                        <option value="">April</option>
                                        <option value="">May</option>
                                        <option value="">June</option>
                                        <option value="">July</option>
                                        <option value="">August</option>
                                        <option value="">September</option>
                                        <option value="">October</option>
                                        <option value="">November</option>
                                        <option value="">December</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="">Persons Involved</label>
                                    <textarea name="" id="" rows="5" class="form-control">Rodrigo Duterte - President of the Philippines; Nancy Robredo - Vice President of the Philippines; CCIT (College of Computing in Information Technology) - College Department
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Number of Days</label>
                                    <!-- <input type="text" class="form-control"> -->
                                    <select name="" id="" class="form-control">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="" selected>5</option>
                                        <option value="">6</option>
                                        <option value="">7</option>
                                        <option value="">8</option>
                                        <option value="">9</option>
                                        <option value="">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Registration Fee</label>
                                    <input type="text" class="form-control" value="5500">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Transpo Air Fare</label>
                                    <input type="text" class="form-control" value="5000">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Hotel Accommodation</label>
                                    <input type="text" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">PER DIEM</label>
                                    <input type="text" class="form-control" value="1500">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <h4 class="col-sm-6 pull-right">
                                <p>
                                    Total Cost: 
                                    <span class="pull-right">P 15, 900.00</span>
                                </p>
                            </h4>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-6 pull-right text-right">
                                <a data-toggle="modal" data-target="#reviewMA" class="btn btn-primary btn-lg">
                                    Re-submit 
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

    <!-- Modal -->
    <div class="modal fade" id="reviewMA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                                    <p class="col-sm-3">
                                        <strong>Title: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE National Conference (NATCON)
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Category: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Research
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Sponsoring Org: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        PSITE Nat'l
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="col-sm-3">
                                        <strong>Venue: </strong>
                                    </p>
                                    <p class="col-sm-9">
                                        Philippines
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">Panel reserved for fees</div>
                        <!-- <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active">Fee</th>
                                        <th class="active">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Registration Fee
                                        </td>
                                        <td>
                                            P5500 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Transportation Air Fee 
                                        </td>
                                        <td>
                                            5000 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            Hotel Accommodation
                                        </td>
                                        <td>
                                            0 <strong>x 5</strong>
                                        </td>
                                    <tr>
                                        <td>
                                            PER DIEM
                                        </td>
                                        <td>
                                            1500 <strong>x 5</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <h4 class="col-sm-6 pull-right">
                                <p>
                                    Total Cost: 
                                    <span class="pull-right">P 15, 900.00</span>
                                </p>
                            </h4>
                        </div> -->

                        <div class="row">
                            <div class="col-sm-7">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Persons Involved</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group" style="height: 300px;overflow-y:auto;">
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
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <button class="btn btn-warning btn-block">For revision <i class="fa fa-paperclip"></i></button>
                                            <!-- <h6 class="small text-muted text-center"><i class="fa fa-check"></i> Seen 11:34pm</h6> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    <a type="button" href="mustAttend.php" class="btn btn-primary btn-lg">Confirm</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
        include('include/foot-acadhead.php');
    ?>

</body>

</html>
