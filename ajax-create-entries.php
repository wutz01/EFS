<?php
require('db/config.php');
session_start();
$request = array_merge($_POST, $_GET);
if (isset($request['mas_id'])) {
  // ADD TO DB
  $mas_id = $request['mas_id'];
  if (isset($request['mode']) && $request['mode'] == 'ADD') {
    if ($request['type'] == 'dean') $type = 'DEAN';
    if ($request['type'] == 'chair') $type = 'CHAIR';
    if ($request['type'] == 'fac') $type = 'FACULTY';
    $hotel = str_replace(',', '', $request['hotel']);
    $diem = str_replace(',', '', $request['diem']);
    $reg = str_replace(',', '', $request['reg']);
    $q = "INSERT INTO `ma_attendees` (`ma_id`, `type`, `hotel`, `diem`, `reg`) VALUES ($mas_id, '$type', $hotel, $diem, $reg)";
    mysqli_query($conn, $q);
    $json['is_successful'] = true;
    $json['msg'] = 'Saved';
    echo json_encode($json, 200);
    die();
  }

  if (isset($request['mode']) && $request['mode'] == 'UPDATE') {
    if ($request['type'] == 'dean') $type = 'DEAN';
    if ($request['type'] == 'chair') $type = 'CHAIR';
    if ($request['type'] == 'fac') $type = 'FACULTY';
    $id = $request['key'];
    $hotel = str_replace(',', '', $request['hotel']);
    $diem = str_replace(',', '', $request['diem']);
    $reg = str_replace(',', '', $request['reg']);
    $q = "UPDATE `ma_attendees` SET `hotel` = $hotel, `diem` = $diem, `reg` = $reg WHERE id = $id";
    mysqli_query($conn, $q);
    $json['is_successful'] = true;
    $json['msg'] = 'Updated';
    echo json_encode($json, 200);
    die();
  }

  // COUNTER DB
  $query = "SELECT * FROM ma_attendees WHERE ma_id = $mas_id";
  $ret = mysqli_query($conn, $query);
  $group = [
    'dean' => [],
    'chair' => [],
    'fac' => []
  ];
  while($result = mysqli_fetch_assoc($ret)) {
    if ($result['type'] == 'DEAN') {
      $group['dean'][$result['id']] = [
        'hotel' => $result['hotel'],
        'diem' => $result['diem'],
        'reg' => $result['reg']
      ];
    }
    if ($result['type'] == 'CHAIR') {
      $group['chair'][$result['id']] = [
        'hotel' => $result['hotel'],
        'diem' => $result['diem'],
        'reg' => $result['reg']
      ];
    }
    if ($result['type'] == 'FACULTY') {
      $group['fac'][$result['id']] = [
        'hotel' => $result['hotel'],
        'diem' => $result['diem'],
        'reg' => $result['reg']
      ];
    }
  }
  $json['is_successful'] = true;
  $json['dean'] = isset($group['dean']) ? count($group['dean']) : 0;
  $json['fac'] = isset($group['fac']) ? count($group['fac']) : 0;
  $json['chair'] = isset($group['chair']) ? count($group['chair']) : 0;
  $json['total'] = $json['dean'] + $json['fac'] + $json['chair'];
  $json['total_transpo'] = 0;
  $mode = $request['transpo_mode'];
  $amount = str_replace(',', '', $request['transpo_amount']);
  if ($request['transpo_mode'] == "COMMUTE") {
    $json['total_transpo'] = $json['total'] * (float) $amount;
  } else {
    $json['total_transpo'] = (float) $amount;
  }

  $hotel = 0;
  $diem = 0;
  $reg = 0;
  if (isset($group)) {
    foreach ($group as $key => $value) {
      foreach($value as $a => $b) {
        $hotel += (float) $b['hotel'];
        $diem += (float) $b['diem'];
        $reg += (float) $b['reg'];
      }
    }
  }
  $total_transpo = $json['total_transpo'];
  $json['total_amount'] = $total_amount = $hotel + $diem + $reg + $total_transpo;
  $q = "UPDATE mustattend SET transpo_total = $total_transpo, reg_total = $reg, transportation = $amount, budget = $total_amount WHERE mas_id = $mas_id";
  mysqli_query($conn, $q);
  echo json_encode($json, 200);
  die();
}

if (isset($request['counter'])) { // get all counts
  $json['is_successful'] = true;
  $json['dean'] = isset($_SESSION['members']) ? count($_SESSION['members']['dean']) : 0;
  $json['fac'] = isset($_SESSION['members']) ? count($_SESSION['members']['fac']) : 0;
  $json['chair'] = isset($_SESSION['members']) ? count($_SESSION['members']['chair']) : 0;
  $json['total'] = $json['dean'] + $json['fac'] + $json['chair'];
  $json['total_transpo'] = 0;
  $mode = $request['transpo_mode'];
  $amount = str_replace(',', '', $request['transpo_amount']);
  if ($request['transpo_mode'] == "COMMUTE") {
    $json['total_transpo'] = $json['total'] * (float) $amount;
  } else {
    $json['total_transpo'] = (float) $amount;
  }

  $hotel = 0;
  $diem = 0;
  $reg = 0;
  if (isset($_SESSION['members'])) {
    $members = $_SESSION['members'];
    foreach ($members as $key => $value) {
      foreach($value as $a => $b) {
        $hotel += (float) $b['hotel'];
        $diem += (float) $b['diem'];
        $reg += (float) $b['reg'];
      }
    }
  }
  $json['total_amount'] = $total_amount = $hotel + $diem + $reg + $json['total_transpo'];
  echo json_encode($json, 200);
  die();
}
if (isset($request['remove'])) { // remove field
  $json['is_successful'] = true;
  $type = $request['type'];
  $key = $request['key'];
  unset($_SESSION['members'][$type][$key]);
  echo json_encode($json, 200);
  die();
}

// create new field
if (!isset($_SESSION['members'])) {
  $_SESSION['members'] = [
    'dean' => [],
    'chair' => [],
    'fac' => []
  ];
}

$type = $request['type'];
$obj = [
  'hotel' => str_replace(',', '', $request['hotel']),
  'diem' => str_replace(',', '', $request['diem']),
  'reg' => str_replace(',', '', $request['reg']),
];
if (isset($request['key'])) {
  $key = $request['key'];
  $_SESSION['members'][$type][$key] = $obj;
} else {
  array_push($_SESSION['members'][$type], $obj);
}
$json['is_successful'] = true;
$json['msg'] = 'Saved';
echo json_encode($json, 200);
die();
?>
