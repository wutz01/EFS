<?php
    include("db/config.php");
    include("action/session-auth.php");
    include("include/head.php");
?>
<!DOCTYPE html>
<html lang="en">
<title> E-FSDP | Acadhead</title>
<body>
    <div id="wrapper">
      <?php include("include/nav.php");?>
      <link rel="stylesheet" href="plugins/DataTables/datatables.min.css">
        <div id="page-wrapper">
            <div class="container-fluid">
              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Must-Attend
                      </h1>
                      <ol class="breadcrumb">
                          <li>
                              <a href="">
                                  <i class="fa fa-book"></i> Manage
                              </a>
                          </li>
                          <li class="active">Must-Attend</li>
                      </ol>
                  </div>
              </div>
              <!-- /.row -->
              <?php $role = $_SESSION['user']; ?>
              <?php if ($role === 'chair') { ?>
              <p class="text-right">
                <a href="create-ma.php"  class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
              </p>
              <?php } ?>
              <div class="row" style="padding-top: 30px;">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-condensed table-hover" width="100%">
                      <thead>
                        <th width="20%" class="text-center">Title</th>
                        <th width="2%" class="text-center">People Involved</th>
                        <th width="10%" class="text-center">Category</th>
                        <th width="10%" class="text-center">Dates</th>
                        <th width="10%" class="text-center">Academic Year</th>
                        <th width="10%" class="text-center">School</th>
                        <th width="5%" class="text-center">Budget</th>
                        <!-- <th width="10%">Date Created</th> -->
                        <th width="10%" class="text-center">Status</th>
                        <th width="5%" class="text-center">Actions</th>
                      </thead>
                      <tbody>
                        <?php
                          $userId = $_SESSION['accID'];
                          $dept = $_SESSION['college'];
                          $str = '';
                          if ($role == 'dean') {
                            $str = "OR (status = 'APPROVED' OR status = 'PENDING_DEAN_REVIEW' OR status = 'PENDING_EDIT_DEAN') AND department = '$dept'";
                          }
                          if ($role == 'chair') {
                            $str = "OR status = 'APPROVED' OR status = 'PENDING_EDIT_CHAIR' AND department = '$dept'";
                          }
                          if ($role == 'faculty' || $role == 'hr') {
                            $str = "OR status = 'APPROVED' AND department = '$dept'";
                          }
                          if ($role == 'vpar') {
                            $str = "OR status = 'APPROVED' OR status = 'PENDING_VP_REVIEW'";
                          }
                          $query = "SELECT * FROM `mustattend` WHERE (createdBy = $userId $str)";
                          $ret = mysqli_query($conn, $query);
                        ?>
                        <?php while($result = mysqli_fetch_array($ret)) { ?>
                        <tr>
                          <td width="20%" class="text-center"><?php echo $result['title'] ?></td>
                          <td width="2%" class="text-center"><?php echo $result['person'] ?></td>
                          <td width="10%" class="text-center"><?php echo $result['category'] ?></td>
                          <td width="10%" class="text-center"><?php echo $result['start_date'] ?> - <?php echo $result['end_date'] ?> (<?php echo $result['days'] ?> days)</td>
                          <td width="10%" class="text-center"><?php echo $result['academicyear'] ?></td>
                          <td width="10%" class="text-center"><?php echo $result['school'] ?> (<?php echo $result['department'] ?>)</td>
                          <td width="5%" class="text-center">PHP <?php echo number_format($result['budget'], 2, '.', ',') ?></td>
                          <!-- <td width="10%"><?php echo $result['addedon'] ?></td> -->
                          <td width="10%" class="text-center <?php echo ($result['status'] == 'APPROVED' ? 'success' : ($result['status'] == 'PENDING_EDIT_DEAN' || $result['status'] == 'PENDING_EDIT_CHAIR' ? 'danger' : 'info')) ?>"><?php echo str_replace('_', ' ', $result['status']) ?></td>
                          <td width="5%" class="text-center">
                            <a href="ma-view.php?id=<?php echo $result['mas_id'] ?>" class="btn btn-xs btn-primary">View</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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
    <script src="plugins/DataTables/datatables.min.js"></script>
    <script>
        $(function(){
          $("#dataTable").DataTable()
            // var lastCount = 0;
            // setInterval(function(){
            //     $.ajax({
            //         type: 'POST',
            //         url: 'action/notif.php',
            //         data: {
            //             lastCount: lastCount
            //         },
            //         success: function(response){
            //             if(lastCount!=response){
            //                 console.log("New Data has been added!");
            //                 $('#titleCount').prepend('('+response+')');
            //                 $('#notifCount').html(response);
            //                 lastCount = response;
            //
            //                 $.gritter.add({
            //                     title: lastCount+' New notification!',
            //                     text: 'Content of Notification',
            //                     sticky: false
            //                 });
            //
            //             }else{
            //                 console.log(response);
            //             }
            //         },
            //         error: function(){
            //             console.log("AW");
            //         }
            //     });
            // },1500);
        })
    </script>
</body>
</html>
