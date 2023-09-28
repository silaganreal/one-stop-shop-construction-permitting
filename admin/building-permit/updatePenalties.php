<?php

if(isset($_POST['btnUpdatePenalties'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dateTime = date('Y-m-d h:i:s');

	$pnltyAssessAmount = $_POST['pnltyAssessAmount'];
	$pnltyAssessBy = $_POST['pnltyAssessBy'];
	$application = $_POST['application'];
	$user = $_POST['user'];
	$appID = $_POST['appID'];
	$assID = $_POST['assID'];
	$assessedFees = $_POST['assessedFees'];

	$sql = $conn->prepare("UPDATE tracking_assessment SET amountDue=?, assessedBy=?, dateTime=?, userID=? WHERE id=? AND onlineappID=?");
	$sql->bind_param("ssssss", $pnltyAssessAmount, $pnltyAssessBy, $dateTime, $LoggedUserID, $assID, $application);

	if($sql->execute()) {
		echo "<script>alert('Penalties has been updated!');window.location.href='assessment.php?application=$application&user=$LoggedUserID&appID=$appID'</script>";
	
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='assessment.php?application=$application&user=$LoggedUserID&appID=$appID'</script>";
	}

} else {
	header('location: ../../login');
}

?>