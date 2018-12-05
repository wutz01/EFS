<!DOCTYPE html>
<html lang="en">
<?php
    include("action/session-auth.php");
    include("include/head.php");
    include("db/config.php");
    $role = $_SESSION['user'];
    $id = (int) $_GET['id'];
    if (!$id) {
      header('Location: ma-list.php');
      die();
    }
    $query = "SELECT * FROM `mustattend` WHERE `mas_id`=$id";
    $ret = mysqli_query($conn, $query);
    $ma = mysqli_fetch_assoc($ret);
    if (!$ma) {
      header('Location: ma-list.php');
      die();
    }
    $q1 = "SELECT * FROM `ma_attendees` WHERE `ma_id`=$id";
    $q1Ret = mysqli_query($conn, $q1);
    $group = [];
    while ($res = mysqli_fetch_assoc($q1Ret)) {
      if ($res['type'] === 'DEAN') {
        $group['dean'][] = [
          'id' => $res['id'],
          'hotel' => $res['hotel'],
          'diem' => $res['diem'],
          'reg' => $res['reg']
        ];
      }
      if ($res['type'] === 'CHAIR') {
        $group['chair'][] = [
          'id' => $res['id'],
          'hotel' => $res['hotel'],
          'diem' => $res['diem'],
          'reg' => $res['reg']
        ];
      }
      if ($res['type'] === 'FACULTY') {
        $group['fac'][] = [
          'id' => $res['id'],
          'hotel' => $res['hotel'],
          'diem' => $res['diem'],
          'reg' => $res['reg']
        ];
      }
    }
?>
<title>E-FSDP | Acadhead</title>
<body>
    <div id="wrapper">
      <?php include("include/nav.php") ?>
      <div id="page-wrapper">
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Must-Attend <small>View</small></h1>
              <ol class="breadcrumb">
                <li>
                  <a href="">
                    <i class="fa fa-book"></i> Manage
                  </a>
                </li>
                <li><a href="ma-list.php">Must-Attend</a></li>
                <li class="active">View</li>
              </ol>
            </div>
            <div class="forms-ma">
              <form action="ajax-save-ma.php" method="post" id="frm-save-ma">
                <div class="col-lg-12">
                  <h3 class="page-header">Details</h3>
                  <?php if ($ma['status'] == 'PENDING_EDIT_DEAN' && $role == 'dean') { ?>
                  <div class="row" style="padding-bottom: 15px">
                    <div class="col-sm-12">
                      <div class="alert alert-danger" role="alert">
                        <strong>REJECTED!</strong>
                        <p><?php echo ucfirst($ma['vp_note']) ?></p>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($ma['status'] == 'PENDING_EDIT_CHAIR' && $role == 'chair') { ?>
                  <div class="row" style="padding-bottom: 15px">
                    <div class="col-sm-12">
                      <div class="alert alert-danger" role="alert">
                        <strong>REJECTED!</strong>
                        <p><?php echo ucfirst($ma['dean_note']) ?></p>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Academic Year</label>
                        <input type="text" id="ma-ay" class="form-control" value="<?php echo $ma['academicyear'] ?>" name="academic_year" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>School</label>
                        <input type="text" class="form-control" value="<?php echo $ma['school'] ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" value="<?php echo $ma['department'] ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Title of Seminar</label>
                        <input type="text" class="form-control" value="<?php echo $ma['title'] ?>" name="seminar_title" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" value="<?php echo $ma['category'] ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Sponsoring Org</label>
                        <input type="text" class="form-control" value="<?php echo $ma['sponsor'] ?>" name="sponsor" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                      <label>Start and End Date</label>
                        <div class="input-group input-daterange">
                          <input type="text" class="form-control date-control" name="start_date" id="start_date" value="<?php echo $ma['start_date'] ?>" readonly>
                          <div class="input-group-addon">to</div>
                          <input type="text" class="form-control date-control" name="end_date" id="end_date" value="<?php echo $ma['end_date'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Days</label>
                        <input type="text" class="form-control text-center" value="<?php echo $ma['days'] ?>" name="days" id="days" readonly>
                        <input type="hidden" class="form-control text-center" value="<?php echo $ma['mas_id'] ?>" id="mas_id" readonly>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Dean</label>
                        <input type="text" class="form-control text-center" value="<?php echo (isset($group['dean']) ? count($group['dean']) : 0) ?>" name="dean" id="dean_counter" readonly>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Chair</label>
                        <input type="text" class="form-control text-center" value="<?php echo (isset($group['chair']) ? count($group['chair']) : 0) ?>" name="chair" id="chair_counter" readonly>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Faculty</label>
                        <input type="text" class="form-control text-center" value="<?php echo (isset($group['fac']) ? count($group['fac']) : 0) ?>" name="faculty" id="fac_counter" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Venue</label>
                        <input type="text" class="form-control" value="<?php echo $ma['venue'] ?>" name="venue" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-sm-4">
                      <?php if (isset($group['dean'])) { ?>
                        <?php foreach($group['dean'] as $key => $value) { ?>
                          <div class="row" style="padding-top: 10px">
                            <div class="col-sm-12">
                              <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">
                                    Dean
                                  </h5>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Hotel</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['hotel'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Diem</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['diem'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Registration</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['reg'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    </div>
                    <div class="col-sm-4">
                      <?php if (isset($group['chair'])) { ?>
                        <?php foreach($group['chair'] as $key => $value) { ?>
                          <div class="row" style="padding-top: 10px">
                            <div class="col-sm-12">
                              <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">
                                    Chair
                                  </h5>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Hotel</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['hotel'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Diem</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['diem'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Registration</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['reg'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    </div>
                    <div class="col-sm-4">
                      <?php if (isset($group['fac'])) { ?>
                        <?php foreach($group['fac'] as $key => $value) { ?>
                          <div class="row" style="padding-top: 10px">
                            <div class="col-sm-12">
                              <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">
                                    Faculty / Staff
                                  </h5>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Hotel</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['hotel'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Diem</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['diem'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label>Registration</label>
                                        <input type="text" class="form-control text-right money" value="<?php echo $value['reg'] ?>" placeholder="0.00" readonly>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12" style="padding-top: 10px">
                  <div class="row">
                    <div class="col-sm-4">
                      <label>Mode of Transportation</label>
                      <input type="text" class="form-control" value="<?php echo str_replace('_', ' ', $ma['transpo_mode']) ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Transportation</label>
                        <div class="input-group">
                          <input type="text" class="form-control money text-right" value="<?php echo number_format($ma['transportation'], 2, '.', ',') ?>" placeholder="0.00" name="general_tranpo" readonly>
                          <span class="input-group-addon">per attendee (commute)</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label>Total Transportation</label>
                      <input type="text" class="form-control text-right" value="<?php echo number_format($ma['transpo_total'], 2, '.', ',') ?>" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <label>Total Registration</label>
                      <input type="text" class="form-control text-right" value="<?php echo number_format($ma['reg_total'], 2, '.', ',') ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Date Created</label>
                        <input type="text" id="ma-dateCreated" class="form-control" name="datecreated" value="<?php echo date('M d, Y H:ia') ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>TOTAL</label>
                        <input type="text" id="total_amount" class="form-control money text-right" name="tota_amount" value="<?php echo number_format($ma['budget'], 2, '.', ',') ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12" style="padding-top: 10px; padding-bottom: 15px;">
                  <?php if (($role == 'dean' && ($ma['status'] == 'PENDING_DEAN_REVIEW' || $ma['status'] == 'PENDING_EDIT_DEAN')) || ($role == 'vpar' && $ma['status'] == 'PENDING_VP_REVIEW')) { ?>
                    <div class="row">
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-success btn-large btn-block" id="approve_btn">APPROVE</button>
                      </div>
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-danger btn-large btn-block" id="reject_btn">REJECT</button>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($role == 'chair' && $ma['status'] == 'PENDING_EDIT_CHAIR') { ?>
                    <div class="row">
                      <div class="col-lg-12">
                        <a href="ma-edit.php?id=<?php echo $ma['mas_id']; ?>" class="btn btn-success btn-large btn-block">EDIT</a>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row" style="padding-top: 10px;">
                    <div class="col-lg-12">
                      <a href="ma-list.php" class="btn btn-primary btn-large btn-block">BACK</a>
                    </div>
                  </div>
                </div>
              </form>
              <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Reject Must Attend</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group">
                            <label>Reject Reason</label>
                            <textarea name="rejectReason" id="rejectReason" class="form-control" rows="8" cols="80"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger" onclick="rejectMa()">Reject</button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- end form-ma -->
          </div> <!-- end row -->
        </div> <!-- end container -->
      </div> <!-- end page wrapper -->
    </div>
    <style>
      .card {
        border: 1px black solid;
        padding: 5px 15px;
      }

      .card-title {
        font-size: 15px;
        font-weight: bold;
      }

      .forms-ma {
        min-height: 700px;
      }
    </style>
    <?php include('include/foot.php') ?>
    <script src="plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery-form.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $('.money').on('change', function () {
          let value = $(this).val()
          value = parseFloat(value.replace(/,/g,''))
          $(this).val(addCommas(value.toFixed(2)))
        })

        $("#approve_btn").on('click', function () {
          let id = $("#mas_id").val()
          $.post('ajax-update-status.php', {id: id, status: 'approved'}, function (o) {
            if (o.is_successful) {
              notify(o.msg, 'success')
              setTimeout(function () {
                location.reload()
              }, 1500)
            } else {
              notify(o.msg, 'warning')
            }
          }, 'json').fail(function (error) {
            console.log(`error`, error)
            notify(error.msg, 'danger')
          })
        })

        $("#reject_btn").on('click', function () {
          // modal
          $("#rejectModal").modal('show');
        })
      })

      function rejectMa () {
        let id = $("#mas_id").val()
        let reason = $("#rejectReason").val()
        if (!reason || reason.length <= 0) {
          notify(`Rejection reason is required.`, 'danger')
          return
        }
        $.post('ajax-update-status.php', {id: id, status: 'rejected', reason: reason}, function (o) {
          if (o.is_successful) {
            notify(o.msg, 'success')
            $("#rejectModal").modal('hide')
            setTimeout(function () {
              location.reload()
            }, 1500)
          } else {
            notify(o.msg, 'warning')
          }
        }, 'json').fail(function (error) {
          console.log(`error`, error)
          notify(error.msg, 'danger')
        })
      }

      function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
      }
    </script>
</body>
</html>
