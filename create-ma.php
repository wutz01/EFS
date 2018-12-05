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
                  <li><a href="ma-list.php">Must-Attend</a></li>
                  <li class="active">Create New</li>
                </ol>
              </div>
              <div class="forms-ma">
                <form action="ajax-save-ma.php" method="post" id="frm-save-ma">
                  <div class="col-lg-12">
                    <h3 class="page-header">Details</h3>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Academic Year</label>
                          <?php
                            $currentYear = date('Y');
                            $yearPlusOne = date('Y', strtotime('+1 year'));
                          ?>
                          <input type="text" id="ma-ay" class="form-control" value="<?php echo $currentYear.'-'.$yearPlusOne ?>" name="academic_year" readonly>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>School</label>
                          <select class="form-control ma-category" name="school">
                            <option value="School of Technology">School of Technology</option>
                            <option value="School of Management">School of Management</option>
                            <option value="School of Humanities">School of Humanities</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
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
                          <input type="text" class="form-control" value="" name="seminar_title" required>
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
                          <input type="text" class="form-control" value="" name="sponsor" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                        <label>Start and End Date</label>
                          <div class="input-group input-daterange">
                            <input type="text" class="form-control date-control" name="start_date" id="start_date" value="2012-04-05" required>
                            <div class="input-group-addon">to</div>
                            <input type="text" class="form-control date-control" name="end_date" id="end_date" value="2012-04-19" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Days</label>
                          <input type="text" class="form-control text-center" value="0" name="days" id="days" readonly>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Dean</label>
                          <input type="text" class="form-control text-center" value="0" name="dean" id="dean_counter" readonly>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Chair</label>
                          <input type="text" class="form-control text-center" value="0" name="chair" id="chair_counter" readonly>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Faculty</label>
                          <input type="text" class="form-control text-center" value="0" name="faculty" id="fac_counter" readonly>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Venue</label>
                          <input type="text" class="form-control" value="" name="venue" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">
                              Dean
                            </h5>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Hotel</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="dean_hotel">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Diem</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="dean_diem">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Registration</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="dean_reg">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary btn-xs" name="button" id="dean_btn">ADD</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Chair</h5>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Hotel</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="chair_hotel">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Diem</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="chair_diem">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Registration</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="chair_reg">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary btn-xs" name="button" id="chair_btn">ADD</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Faculty / Staff</h5>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Hotel</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="fac_hotel">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Diem</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="fac_diem">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Registration</label>
                                  <input type="text" class="form-control text-right money" value="0.00" placeholder="0.00" id="fac_reg">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary btn-xs" name="button" id="fac_btn">ADD</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12" style="padding-top: 10px">
                    <div class="row">
                      <div class="col-sm-4">
                        <div id="dean_wrapper"></div>
                      </div>
                      <div class="col-sm-4">
                        <div id="chair_wrapper"></div>
                      </div>
                      <div class="col-sm-4">
                        <div id="fac_wrapper"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12" style="padding-top: 10px">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Mode of Transportation</label>
                        <div class="form-inline form-group">
                          <div class="radio" style="padding: 0px 15px">
                            <label>
                              <input type="radio" name="transpo_mode" id="transpo_school" value="SCHOOL_SERVICE">
                              School service
                            </label>
                          </div>
                          <div class="radio" style="padding: 0px 15px">
                            <label>
                              <input type="radio" name="transpo_mode" id="transpo_rent" value="RENT">
                              Rent a service
                            </label>
                          </div>
                          <div class="radio" style="padding: 0px 15px">
                            <label>
                              <input type="radio" name="transpo_mode" id="transpo_commute" value="COMMUTE" checked>
                              Commute
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Transportation</label>
                          <div class="input-group">
                            <input type="text" class="form-control money text-right" value="0.00" placeholder="0.00" name="general_tranpo" id="general_tranpo">
                            <span class="input-group-addon">per attendee (commute)</span>
                          </div>
                        </div>
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
                          <input type="text" id="total_amount" class="form-control money text-right" name="tota_amount" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12" style="padding-top: 10px; padding-bottom: 15px;">
                    <div class="row">
                      <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-large btn-block">CREATE</button>
                      </div>
                    </div>
                  </div>
                </form>
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

        loadEntries('dean')
        loadEntries('chair')
        loadEntries('fac')
        $('.input-daterange input').each(function() {
          $(this).datepicker('clearDates');
        });

        $("#dean_btn").on('click', function () {
          createEntries('dean')
        })
        $("#chair_btn").on('click', function () {
          createEntries('chair')
        })
        $("#fac_btn").on('click', function () {
          createEntries('fac')
        })

        $('.money').on('change', function () {
          let value = $(this).val()
          value = parseFloat(value.replace(/,/g,''))
          $(this).val(addCommas(value.toFixed(2)))
        })

        $("#start_date, #end_date").on('change', function () {
          let start_date = $("#start_date").val()
          let end_date = $("#end_date").val()

          if (start_date.length > 0 && end_date.length > 0 && start_date && end_date) {
            let days = getDaysBetweenDates(start_date, end_date)
            $("#days").val(days + 1)
          }
        })

        $("#general_tranpo").on('change', function () {
          loadCount()
        })

        $("#transpo_school").on('click', function () {
          $("#general_tranpo").val('0.00');
          $("#general_tranpo").prop('readonly', true).change()
        })

        $("#transpo_commute, #transpo_rent").on('click', function () {
          loadCount()
          $("#general_tranpo").prop('readonly', false).change()
        })

        $('#frm-save-ma').ajaxForm({
          dataType: 'json',
          success: (o) => {
            if (o.is_successful) {
              notify(o.msg, 'success')
              $("#frm-save-ma")[0].reset()
              loadEntries('dean')
              loadEntries('chair')
              loadEntries('fac')
            } else {
              notify(o.msg, 'danger')
            }
          },
          beforeSubmit: (o) => {
            // notify('sending data...', 'info')
          }
        });
      })

      function getDaysBetweenDates(d0, d1) {
        var msPerDay = 8.64e7;
        // Copy dates so don't mess them up
        var x0 = new Date(d0);
        var x1 = new Date(d1);
        // Set to noon - avoid DST errors
        x0.setHours(12,0,0);
        x1.setHours(12,0,0);
        // Round to remove daylight saving errors
        return Math.round( (x1 - x0) / msPerDay );
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

      function createEntries (type) {
        let hotel = $(`#${type}_hotel`).val()
        let diem = $(`#${type}_diem`).val()
        let reg = $(`#${type}_reg`).val()

        hotel = parseFloat(hotel.replace(/,/g, ''))
        diem = parseFloat(diem.replace(/,/g, ''))
        reg = parseFloat(reg.replace(/,/g, ''))

        if (!$.trim(hotel).length || !$.trim(diem).length || !$.trim(reg).length) {
          notify('Invalid input', 'danger')
          return
        }
        $.post('ajax-create-entries.php', {type: type, hotel: hotel, diem: diem, reg: reg}, function (o) {
          loadEntries(type)
          $(`#${type}_hotel`).val(0.00)
          $(`#${type}_diem`).val(0.00)
          $(`#${type}_reg`).val(0.00)
        }, 'json').fail(function () {
          notify(`failed loading data ${type}`, 'danger')
        });
      }

      function loadEntries (type) {
        $.post('ajax-entries.php', {type: type}, function (o) {
          $(`#${type}_wrapper`).html(o)
          loadCount()
        }).fail(function () {
          notify(`failed loading data ${type}`, 'danger')
        });
      }

      function removeForm (type, key) {
        $.post('ajax-create-entries.php', {type: type, key: key, remove: true}, function (o) {
          loadEntries(type)
        }).fail(function () {
          notify(`failed loading data ${type}`, 'danger')
        });
      }

      function loadCount () {
        let transpo_amount = $("#general_tranpo").val()
        let transpo_mode = $("input[name=transpo_mode]:checked").val()
        $.post('ajax-create-entries.php', {counter: true, transpo_amount: transpo_amount, transpo_mode: transpo_mode}, function (o) {
          $(`#dean_counter`).val(o.dean)
          $(`#chair_counter`).val(o.chair)
          $(`#fac_counter`).val(o.fac)
          $("#total_amount").val(o.total_amount).change()
          if (o.total < 3) {
            $("#transpo_commute").prop('checked', true).change()
            $("#transpo_rent").prop('disabled', true).change()
            $("#transpo_school").prop('disabled', true).change()
          } else {
            $("#transpo_rent").prop('disabled', false).change()
            $("#transpo_school").prop('disabled', false).change()
          }
        }, 'json').fail(function () {
          notify(`failed loading data count`, 'danger')
        });
      }
    </script>
</body>
</html>
