<?php

if(isset($_POST['updateAssessment'])) {

	include "../../includes2/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dateTime = date('Y-m-d h:i:s');

	$assessAmount = $_POST['assessAmount'];
	$assessBy = $_POST['assessBy'];
	$assessID = $_POST['assessID'];
	$onlineappID = $_POST['onlineappID'];
	$loggedUser = $_POST['loggedUser'];
	$assessedFees = $_POST['assessedFees'];
	$slug = $_POST['assessSlug'];

	$sql = $conn->prepare("UPDATE lc_assessment SET amountDue=?, assessedBy=?, dateTime=?, userID=? WHERE id=?");
	$sql->bind_param("sssss", $assessAmount, $assessBy, $dateTime, $loggedUser, $assessID);

	if($sql->execute()) {
		$sql2 = $conn->prepare("UPDATE onlineapplications SET applicationRemarks=? WHERE id=?");
		$sql2->bind_param("ss", $assessedFees, $onlineappID);
		$sql2->execute();
		echo "<script>alert('Successful update!');window.location.href='../assessment/?slug=$slug'</script>";
	} else {
		$error = 'Error: '. $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../assessment/?slug=$slug'</script>";
	}

}

?>