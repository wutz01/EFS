<!DOCTYPE html>
<html lang="en">
<?php
    include("action/session-auth.php");
    include("include/head.php");
    include("db/config.php");
?>
<title>E-FSDP | Acadhead</title>
<!-- CSS -->
<link href="plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<body>
    <div id="wrapper">
      <?php include("include/nav.php") ?>
        <div id="page-wrapper">
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Must-Attend <small>Create New</small></h1>
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

              <div class="col-lg-12">
                <h3 class="page-header">Details</h3>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Academic Year</label>
                      <?php
                        $currentYear = date('Y');
                        $yearPlusOne = date('Y', strtotime('+1 year'));
                      ?>
                      <input type="text" id="ma-ay" class="form-control" value="<?php echo $currentYear.'-'.$yearPlusOne ?>" name="academic_year" readonly>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Date Created</label>
                      <input type="text" id="ma-dateCreated" class="form-control" name = "datecreated" value="<?php echo date('M d, Y H:ia') ?>" readonly>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>School</label>
                      <select class="form-control ma-category" name="school">
                        <option value="School of Technology">School of Technology</option>
                        <option value="School of Management">School of Management</option>
                        <option value="School of Humanities">School of Humanities</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Department</label>
                      <select class="form-control ma-category" name="department">
                        <option value="CCIT">CCIT</option>
                        <option value="COE">COE</option>
                        <option value="COPS">COPS</option>
                        <option value="CAS">CAS</option>
                        <option value="CITHM">CITHM</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Title of Seminar</label>
                      <input type="text" class="form-control" value="" name="seminar_title">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control ma-category" name="category">
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
                      <input type="text" class="form-control" value="" name="sponsor">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Start and End Date</label>
                      <div class="input-group input-daterange">
                        <input type="text" class="form-control date-control" value="2012-04-05">
                        <div class="input-group-addon">to</div>
                        <input type="text" class="form-control date-control" value="2012-04-19">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Days</label>
                      <input type="text" class="form-control" value="" name="days" id="days" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Venue</label>
                      <input type="text" class="form-control" value="" name="venue">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div> <!-- end row -->
          </div> <!-- end container -->
        </div> <!-- end page wrapper -->
    </div>
    <?php include('include/foot.php') ?>
    <script src="plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $('.input-daterange input').each(function() {
          $(this).datepicker('clearDates');
        });
      })
    </script>
</body>
</html>
