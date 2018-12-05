<?php
  require('db/config.php');
  session_start();
  $role = $_SESSION['user'];
  $id = $_POST['id'];
  $status = $_POST['status'];
  $str = '';
  $rejectReason = '';
  if ($role == 'dean') {
    $str = " AND status = 'PENDING_DEAN_REVIEW' OR status = 'PENDING_EDIT_DEAN'";
  }
  if ($role == 'vpar') {
    $str = " AND status = 'PENDING_VP_REVIEW'";
  }
  if ($status == 'rejected') {
    $rejectReason = htmlentities($_POST['reason'], ENT_QUOTES);
  }
  $q = "SELECT * FROM mustattend WHERE mas_id = $id$str";
  $ret = mysqli_query($conn, $q);
  $result = mysqli_fetch_assoc($ret);
  $json['reason'] = $rejectReason;
  $qStr = '';
  if ($result) {
    if ($status == 'approved') {
      if ($role == 'dean') {
        $qStr = "dean_status = 'APPROVED', status = 'PENDING_VP_REVIEW', dean_note = ''";
      }
      if ($role == 'vpar') {
        $qStr = "vp_status = 'APPROVED', status = 'APPROVED', vp_note = ''";
      }
    } else {
      if ($role == 'dean') {
        $qStr = "dean_status = 'REJECTED', status = 'PENDING_EDIT_CHAIR', dean_note = '$rejectReason'";
      }
      if ($role == 'vpar') {
        $qStr = "vp_status = 'REJECTED', status = 'PENDING_EDIT_DEAN', vp_note = '$rejectReason'";
      }
    }
    if (!empty($qStr)) {
      $query = "UPDATE mustattend SET $qStr WHERE mas_id = $id";
      $r = mysqli_query($conn, $query);
      if ($r) {
        $json['is_successful'] = true;
        $json['msg'] = "Data has been updated";
      } else {
        $json['query'] = $query;
        $json['is_successful'] = false;
        $json['msg'] = "There has been error updating your data.";
      }
    } else {
      $json['is_successful'] = false;
      $json['msg'] = "There has been error updating your data.";
    }
  } else {
    $json['is_successful'] = false;
    $json['msg'] = "Data not found. Either data status has been updated or data does not exist";
  }

  echo json_encode($json, 200);
  die();
?>
