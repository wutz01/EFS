<?php
  require('db/config.php');
  session_start();
  // $query  = "SELECT * FROM `mustattend`";
  // $result = mysqli_query($conn, $query);
  // $row    = mysqli_fetch_array($result);
  $request = array_merge($_POST, $_GET);
  // print_r($request);
  // die();

  $userId = $_SESSION['accID'];
  $title = $request['seminar_title'];
  $category = $request['category'];
  $sponsor = $request['sponsor'];
  $start_date = $request['start_date'];
  $end_date = $request['end_date'];
  $days = $request['days'];
  $venue = $request['venue'];
  $person = 0; // total count
  $academicyear = $request['academic_year'];
  $department = $request['department'];
  $school = $request['school'];
  $total = $request['tota_amount'];
  $transpoEach = str_replace(',', '', $request['general_tranpo']);
  $datecreated = date('M d, Y h:ia');


  if (isset($request['mas_id'])) {
    // UPDATE
    $mas_id = $request['mas_id'];
    $getQuery = "SELECT * FROM ma_attendees WHERE ma_id = $mas_id";
    $retAtt = mysqli_query($conn, $getQuery);
    $group = [
      "dean" => [],
      "chair" => [],
      "fac" => []
    ];
    while($res = mysqli_fetch_assoc($retAtt)) {
      if ($res['type'] == "DEAN") {
        $group['dean'][] = [
          "hotel" => $res['hotel'],
          "reg" => $res['reg'],
          "diem" => $res['diem'],
        ];
      }
      if ($res['type'] == "CHAIR") {
        $group['chair'][] = [
          "hotel" => $res['hotel'],
          "reg" => $res['reg'],
          "diem" => $res['diem'],
        ];
      }
      if ($res['type'] == "FACULTY") {
        $group['fac'][] = [
          "hotel" => $res['hotel'],
          "reg" => $res['reg'],
          "diem" => $res['diem'],
        ];
      }
    }

    $dean_count = count($group['dean']);
    $fac_count = count($group['fac']);
    $chair_count = count($group['chair']);
    $person = $dean_count + $fac_count + $chair_count;
    $mode = $request['transpo_mode'];
    $total_transpo = 0;
    if ($mode == "COMMUTE") {
      $total_transpo = $person * (float) $transpoEach;
    } else {
      $total_transpo = (float) $transpoEach;
    }

    $hotel = 0;
    $diem = 0;
    $reg = 0;
    foreach ($group as $key => $value) {
      foreach($value as $a => $b) {
        $hotel += (float) $b['hotel'];
        $diem += (float) $b['diem'];
        $reg += (float) $b['reg'];
      }
    }
    $total_amount = $hotel + $diem + $reg + $total_transpo;
    $updateQ = "UPDATE `mustattend` SET `title` = '$title', `category` = '$category', `sponsor` = '$sponsor', `start_date` = '$start_date', `end_date` = '$end_date', `days` = $days, `venue` = '$venue', `person` = $person, `academicyear` = '$academicyear', `department` = '$department', `school` = '$school', `budget` = $total_amount, `transpo_total` = $total_transpo, `reg_total` = $reg, `transpo_mode` = '$mode', `status` = 'PENDING_DEAN_REVIEW', `dean_note` = '', `vp_note` = '', `dean_status` = 'FOR_REVIEW', `vp_status` = 'FOR_APPROVAL' WHERE mas_id = $mas_id";
    mysqli_query($conn, $updateQ);
    $json['is_successful'] = true;
    $json['msg'] = 'Successfully updated event';
  } else {
    // CREATE
    $dean_count = count($_SESSION['members']['dean']);
    $fac_count = count($_SESSION['members']['fac']);
    $chair_count = count($_SESSION['members']['chair']);
    $person = $dean_count + $fac_count + $chair_count;
    $mode = $request['transpo_mode'];
    $total_transpo = 0;
    if ($mode == "COMMUTE") {
      $total_transpo = $person * (float) $transpoEach;
    } else {
      $total_transpo = (float) $transpoEach;
    }

    $members = $_SESSION['members'];
    $hotel = 0;
    $diem = 0;
    $reg = 0;
    foreach ($members as $key => $value) {
      foreach($value as $a => $b) {
        $hotel += (float) $b['hotel'];
        $diem += (float) $b['diem'];
        $reg += (float) $b['reg'];
      }
    }

    $total_amount = $hotel + $diem + $reg + $total_transpo;
    $query = "INSERT INTO `mustattend` (`title`, `category`, `sponsor`, `start_date`, `end_date`, `days`, `venue`, `person`, `academicyear`, `department`, `school`, `budget`, `transpo_total`, `reg_total`, `transpo_mode`, `addedon`, `dean_status`, `vp_status`, `status`, `transportation`, `createdBy`) VALUES ('$title', '$category', '$sponsor', '$start_date', '$end_date', $days, '$venue', $person, '$academicyear', '$department', '$school', $total_amount, $total_transpo, $reg, '$mode', '$datecreated', 'NEW', 'NEW', 'PENDING_DEAN_REVIEW', $total_transpo, $userId)";
    if ($person <= 0) {
      $json['is_successful'] = false;
      $json['msg'] = 'We need people to attend the event';
      echo json_encode($json, 200);
      exit();
    }
    if ($res = mysqli_query($conn, $query)) {
      $last_id = mysqli_insert_id($conn);
      foreach ($members as $key => $value) {
        if ($key == 'dean') {
          $type = 'DEAN';
        }
        if ($key == 'chair') $type = 'CHAIR';
        if ($key == 'fac') $type = 'FACULTY';
        foreach ($value as $a => $b) {
          $hotel = (float) $b['hotel'];
          $diem = (float) $b['diem'];
          $reg = (float) $b['reg'];
          $q = "INSERT INTO `ma_attendees` (`ma_id`, `type`, `hotel`, `diem`, `reg`) VALUES ($last_id, '$type', $hotel, $diem, $reg)";
          mysqli_query($conn, $q);
        }
      }
      unset($_SESSION['members']);
      $qRemarks = "INSERT INTO `mas_remarks` (`mas_id`, `dean_status`, `vp_status`, `hr_status`) VALUES ($last_id, 'NEW', 'PENDING_DEAN_REVIEW', 'PENDING_VP_REVIEW')";
      mysqli_query($conn, $qRemarks);
    }
    $json['is_successful'] = true;
    $json['msg'] = 'Successfully created a new event';
  }

  echo json_encode($json, 200);
?>
