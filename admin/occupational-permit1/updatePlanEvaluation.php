<?php

if(isset($_POST['updatePlanEvaluation'])) {

	include '../includes/auth.php';
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$peStatus = $_POST['peStatus'];
	$peRemarks = $_POST['peRemarks'];
	$peID = $_POST['peID'];
	$timeOut = date('h:i:s');
	$dateOut = date('Y-m-d');
	$application = $_POST['application'];
	$user = $_POST['user'];
	$appID = $_POST['appID'];

	$sql = $conn->prepare("UPDATE tracking_plan_evaluation SET timeOut=?, dateOut=?, status=?, remarks=? WHERE id=?");
	$sql->bind_param("sssss", $timeOut, $dateOut, $peStatus, $peRemarks, $peID);

	if($sql->execute()) {
		echo "<script>alert('Status has been updated!');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";
	} else {

		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";

	}

} else {
	echo "<script>alert('What are you doing here?');window.location.href='../../login'</script>";
}

?>