<?php

include "../includes/auth.php";

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if( (isset($_GET['application'])) && (isset($_GET['userAppID'])) ) {
	$application = $_GET['application'];
	$userAppID = $_GET['userAppID'];
	date_default_timezone_set("Asia/Kuala_Lumpur");

	$sql = "SELECT * FROM tracking_assessment WHERE onlineappID = '$application'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);

	$sql2 = "SELECT * FROM userapplications WHERE id = '$userAppID'";
	$res2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($res2);

	$newFileName = $application .'-'. $userAppID .'-'. $row2['applicantName'];

	$sql3 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Filing Fee'";
	$res3 = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_assoc($res3);
	$filingFee = $row3['amountDue'];

	$sql4 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Land Use & Zoning'";
	$res4 = mysqli_query($conn, $sql4);
	$row4 = mysqli_fetch_assoc($res4);
	$landUse = $row4['amountDue'];

	$sql5 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Line & Grade'";
	$res5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_assoc($res5);
	$lineGrade = $row5['amountDue'];

	$sql6 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Excavation'";
	$res6 = mysqli_query($conn, $sql6);
	$row6 = mysqli_fetch_assoc($res6);
	$excavation = $row6['amountDue'];

	$sql7 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Fencing'";
	$res7 = mysqli_query($conn, $sql7);
	$row7 = mysqli_fetch_assoc($res7);
	$fencing = $row7['amountDue'];

	$sql8 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Civil/Structural'";
	$res8 = mysqli_query($conn, $sql8);
	$row8 = mysqli_fetch_assoc($res8);
	$civilStructural = $row8['amountDue'];

	$sql9 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Electrical'";
	$res9 = mysqli_query($conn, $sql9);
	$row9 = mysqli_fetch_assoc($res9);
	$electrical = $row9['amountDue'];

	$sql10 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Mechanical'";
	$res10 = mysqli_query($conn, $sql10);
	$row10 = mysqli_fetch_assoc($res10);
	$mechanical = $row10['amountDue'];

	$sql11 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Sanitary/Plumbing'";
	$res11 = mysqli_query($conn, $sql11);
	$row11 = mysqli_fetch_assoc($res11);
	$sanitaryPlumbing = $row11['amountDue'];

	$sql12 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Electronics'";
	$res12 = mysqli_query($conn, $sql12);
	$row12 = mysqli_fetch_assoc($res12);
	$electronics = $row12['amountDue'];

	$sql13 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Interior'";
	$res13 = mysqli_query($conn, $sql13);
	$row13 = mysqli_fetch_assoc($res13);
	$interior = $row13['amountDue'];

	$sql14 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Surcharges'";
	$res14 = mysqli_query($conn, $sql14);
	$row14 = mysqli_fetch_assoc($res14);
	$surcharges = $row14['amountDue'];

	$sql15 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Penalties'";
	$res15 = mysqli_query($conn, $sql15);
	$row15 = mysqli_fetch_assoc($res15);
	$penalties = $row15['amountDue'];

	$sql16 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Project Cost'";
	$res16 = mysqli_query($conn, $sql16);
	$row16 = mysqli_fetch_assoc($res16);
	$projectCost = $row16['amountDue'];

	$sql17 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Labor Cost'";
	$res17 = mysqli_query($conn, $sql17);
	$row17 = mysqli_fetch_assoc($res17);
	$laborCost = $row17['amountDue'];

	$sql18 = "SELECT amountDue FROM tracking_assessment WHERE onlineappID = '$application' AND assessedFees = 'Contractors Tax'";
	$res18 = mysqli_query($conn, $sql18);
	$row18 = mysqli_fetch_assoc($res18);
	$contractorsTax = $row18['amountDue'];

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../../uploads/template.xlsx");

	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('E8', strtoupper($row2['applicantName']));
	$sheet->setCellValue('M8', date('Y-m-d'));
	$sheet->setCellValue('D9', strtoupper($row2['ownerAddress']));
	$sheet->setCellValue('D10', strtoupper($row2['projectTitle']));
	$sheet->setCellValue('E11', strtoupper($row2['tdnKind']));
	
	//Filing Fee
	$sheet->setCellValue('L20', $filingFee);
	$sheet->setCellValue('M20', $filingFee * 0.80);
	$sheet->setCellValue('N20', $filingFee * 0.15);
	$sheet->setCellValue('O20', $filingFee * 0.05);

	//Land Use & Zoning
	$sheet->setCellValue('L22', $landUse);
	$sheet->setCellValue('M22', $landUse * 0.80);
	$sheet->setCellValue('N22', $landUse * 0.15);
	$sheet->setCellValue('O22', $landUse * 0.05);

	//Line & Grade
	$sheet->setCellValue('L23', $lineGrade);
	$sheet->setCellValue('M23', $lineGrade * 0.80);
	$sheet->setCellValue('N23', $lineGrade * 0.15);
	$sheet->setCellValue('O23', $lineGrade * 0.05);

	//Excavation
	$sheet->setCellValue('L24', $excavation);
	$sheet->setCellValue('M24', $excavation * 0.80);
	$sheet->setCellValue('N24', $excavation * 0.15);
	$sheet->setCellValue('O24', $excavation * 0.05);

	//Fencing
	$sheet->setCellValue('L26', $fencing);
	$sheet->setCellValue('M26', $fencing * 0.80);
	$sheet->setCellValue('N26', $fencing * 0.15);
	$sheet->setCellValue('O26', $fencing * 0.05);

	//Civil/Structural
	$sheet->setCellValue('L36', $civilStructural);
	$sheet->setCellValue('M36', $civilStructural * 0.80);
	$sheet->setCellValue('N36', $civilStructural * 0.15);
	$sheet->setCellValue('O36', $civilStructural * 0.05);

	//Electrical
	$sheet->setCellValue('L37', $electrical);
	$sheet->setCellValue('M37', $electrical * 0.80);
	$sheet->setCellValue('N37', $electrical * 0.15);
	$sheet->setCellValue('O37', $electrical * 0.05);

	//Mechanical
	$sheet->setCellValue('L38', $mechanical);
	$sheet->setCellValue('M38', $mechanical * 0.80);
	$sheet->setCellValue('N38', $mechanical * 0.15);
	$sheet->setCellValue('O38', $mechanical * 0.05);

	//Sanitary/Plumbing
	$sheet->setCellValue('L39', $sanitaryPlumbing);
	$sheet->setCellValue('M39', $sanitaryPlumbing * 0.80);
	$sheet->setCellValue('N39', $sanitaryPlumbing * 0.15);
	$sheet->setCellValue('O39', $sanitaryPlumbing * 0.05);

	//Electronics
	$sheet->setCellValue('L41', $electronics);
	$sheet->setCellValue('M41', $electronics * 0.80);
	$sheet->setCellValue('N41', $electronics * 0.15);
	$sheet->setCellValue('O41', $electronics * 0.05);

	//Interior
	$sheet->setCellValue('L42', $interior);
	$sheet->setCellValue('M42', $interior * 0.80);
	$sheet->setCellValue('N42', $interior * 0.15);
	$sheet->setCellValue('O42', $interior * 0.05);

	//Surcharges
	$sheet->setCellValue('L63', $surcharges);
	$sheet->setCellValue('M63', $surcharges * 0.80);
	$sheet->setCellValue('N63', $surcharges * 0.15);
	$sheet->setCellValue('O63', $surcharges * 0.05);

	//Penalties
	$sheet->setCellValue('L64', $penalties);
	$sheet->setCellValue('M64', $penalties * 0.80);
	$sheet->setCellValue('N64', $penalties * 0.15);
	$sheet->setCellValue('O64', $penalties * 0.05);

	//Project Cost
	$sheet->setCellValue('H76', $projectCost);

	//Labor Cost
	// $sheet->setCellValue('L63', $laborCost);

	//Contractors Tax
	$sheet->setCellValue('L78', $contractorsTax);

	$writer = new Xlsx($spreadsheet);
	$writer->save('../../uploads/permits/'. $newFileName .'.xlsx');

	// echo "<a href='template.xlsx' target='_blank'>Download</a>";

	$file = "./../../uploads/permits/". $newFileName .".xlsx";

	header('Pragma: public'); // required
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);    // required for certain browsers
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename='. $newFileName .'.xlsx;' );
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '. filesize($file));
    readfile($file);

} else {
	header('location: ../../');
}

?>