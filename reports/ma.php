<?php
ob_start();
require('../db/config.php');
require_once('../tcpdf/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator('EFS Management');
$pdf->SetAuthor('EFS');
$pdf->SetTitle('Must Attend Reports');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Must Attend Reports', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$request = array_merge($_POST, $_GET);
$str = '';
$hasSearch = false;
if (count($request) > 0) {
  $hasSearch = true;
}
if ($hasSearch) {
  $str .= " WHERE ";
  if (isset($request['dept'])) {
    $dept = $request['dept'];
    $str .= "department = '$dept'";
  }

  if (isset($request['end_date']) && isset($request['start_date'])) {
    $start_date = $request['start_date'];
    $end_date = $request['end_date'];
    $str .= "(start_date BETWEEN '$start_date' AND '$end_date') AND (end_date BETWEEN '$start_date' AND '$end_date')";
  }
}

$query = "SELECT * FROM mustattend $str ORDER BY start_date";
// print_r($query);
// die();
$ret = mysqli_query($conn, $query);
$tbl = '<table cellspacing="0" border="1">';
    $tbl .= '<tr>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Title</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Category</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">School</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Department</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Academic Year</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Dates</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold"># Involved</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Budget</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Sponsor</td>';
    $tbl .= '<td style="text-align: center; font-size: 10px; font-weight: bold">Status</td>';
    $tbl .= '</tr>';
  while($result = mysqli_fetch_assoc($ret)) {
    $tbl .= '<tr>';
        $tbl .= '<td style="text-align: center;">'. $result['title'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['category'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['school'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['department'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['academicyear'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. '(' . $result['days'] . ' days) <br>' . $result['start_date'] .'<br>-<br>'. $result['end_date'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['person'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. 'PHP ' . number_format($result['budget'], 2, '.', ',') .'</td>';
        $tbl .= '<td style="text-align: center;">'. $result['sponsor'] .'</td>';
        $tbl .= '<td style="text-align: center;">'. str_replace('_', ' ', $result['status']) .'</td>';
    $tbl .= '</tr>';
  }
$tbl .= '</table>';
?>
<style>
  table {
    width: 100%;
  }
  table > tr > td {
    padding: 10px 10px;
    margin: 10px 10px;
  }
</style>
<?php
$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('mas report.pdf', 'I');
?>
