<?php

if(isset($_POST['updateLaborCost'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dateTime = date('Y-m-d h:i:s');

	$assessAmount = $_POST['assessAmount'];
	$assID = $_POST['assID'];
	$application = $_POST['application'];
	$user = $_POST['user'];
	$appID = $_POST['appID'];
	$assessedFees = $_POST['assessedFees'];

	$sql = $conn->prepare("UPDATE tracking_assessment SET amountDue=?, dateTime=?, userID=? WHERE id=? AND onlineappID=?");
	$sql->bind_param("sssss", $assessAmount, $dateTime, $LoggedUserID, $assID, $application);

	if($sql->execute()) {
		echo "<script>alert('Updated successfully!');window.location.href='assessment.php?application=$application&user=$user&appID=$appID'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='assessment.php?application=$application&user=$user&appID=$appID'</script>";
	}

} else {
	header('location: ../../login');
}

?>