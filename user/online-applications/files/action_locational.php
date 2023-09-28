<?php

include "../../includes/auth2.php";

if(isset($_POST['submitApplicationLC'])) {

	date_default_timezone_set("Asia/Kuala_Lumpur");
	$appDate = date('Y-m-d');
	$appTime = date('h:i:s');

	$userID = $_POST['userID'];
	$appID = $_POST['appID'];
	$appType = $_POST['applicationType'];

	$randomChar1 = substr(str_shuffle('1234567890'),0,4);
	$randomChar2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,4);
	$slug = $randomChar1 .'-'. $randomChar2;

	$sql = "SELECT * FROM onlineapplications WHERE userID = '$userID' AND userappID = '$appID' AND applicationType = '$appType' AND applicationStatus != 'Released'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 0) {
		$currentArea = 'Document Verification';
		$appStatus = 'For '. $currentArea;
		include "fx_locational.php";
		addNewApplication($userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug);
	} else {
		$row = mysqli_fetch_assoc($res);
		if($row['applicationStatus'] != 'Document Verification') {
			$currentArea = 'Document Verification';
			$appStatus = 'For '. $currentArea;
			include "fx_locational.php";
			addNewApplication($userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug);
		} else {
			echo "<script>alert('You still have an application that is still On-Progress. Please wait until is finished.');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
		}
	}
} else {
	header('location: ../../../login');
}

?>