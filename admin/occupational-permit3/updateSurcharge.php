<?php

if(isset($_POST['btnSaveSurcharge'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dateTime = date('Y-m-d h:i:s');

	$assessID = $_POST['assessID'];
	$onlineappID = $_POST['onlineappID'];
	$percentage = $_POST['percentage'];
	$inpTotalAmount = $_POST['inpTotalAmount'];
	$applicationID = $_POST['applicationID'];
	$appID = $_POST['appID'];

	$sql = $conn->prepare("UPDATE tracking_assessment SET amountDue=?, percentage=?, assessedBy=?, dateTime=?, userID=? WHERE id=? AND onlineappID=?");
	$sql->bind_param("sssssss", $inpTotalAmount, $percentage, $LoggedUserName, $dateTime, $LoggedUserID, $assessID, $onlineappID);

	if($sql->execute()) {
		echo "<script>alert('Surcharge has been updated!');window.location.href='assessment.php?application=$applicationID&user=$LoggedUserID&appID=$appID'</script>";
	
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='assessment.php?application=$applicationID&user=$LoggedUserID&appID=$appID'</script>";
	}

}

?>