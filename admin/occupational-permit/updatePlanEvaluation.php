<?php

function update_notifications($appID, $application, $dateIn, $user) {
	include '../includes/connect.php';
	$sql2 = "SELECT * FROM notifications WHERE userappID = '$appID' AND onlineappID = '$application' ORDER BY dateIn DESC LIMIT 1";
	$res2 = mysqli_query($conn, $sql2);
	$num2 = mysqli_num_rows($res2);

	if($num2 > 0) {
		$row2 = mysqli_fetch_assoc($res2);
		$notifID = $row2['id'];
		$notifStat = $row2['status'];
		if($notifStat === 'N') {
			$newStat = 'Y';
			$sql4 = $conn->prepare("UPDATE notifications SET status=?, dateIn=? WHERE userappID=? AND onlineappID=?");
			$sql4->bind_param("ssss", $newStat, $dateIn, $appID, $application);
			$sql4->execute();

			$sql7 = $conn->prepare("INSERT INTO notifications(userappID, onlineappID, dateIn) VALUES(?,?,?)");
			$sql7->bind_param("sss", $appID, $application, $dateIn);
			$sql7->execute();
			echo "
				<script>
					alert('Status has been updated. Forwarded to next step.');
					window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'
				</script>
			";
		} else {
			$sql5 = $conn->prepare("INSERT INTO notifications(userappID, onlineappID, dateIn) VALUES(?,?,?)");
			$sql5->bind_param("sss", $appID, $application, $dateIn);
			$sql5->execute();
			echo "
				<script>
					alert('Status has been updated. Forwarded to next step.');
					window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'
				</script>
			";
		}
	} else {
		$sql6 = $conn->prepare("INSERT INTO notifications(userappID, onlineappID, dateIn) VALUES(?,?,?)");
		$sql6->bind_param("sss", $appID, $application, $dateIn);
		$sql6->execute();
		echo "
			<script>
				alert('Status has been updated. Forwarded to next step.');
				window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'
			</script>
		";
	}
}

if(isset($_POST['updatePlanEvaluation'])) {

	include '../includes/auth.php';
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$peStatus = $_POST['peStatus'];
	$peRemarks = $_POST['peRemarks'];
	$peID = $_POST['peID'];
	$timeOut = date('h:i:s');
	$dateOut = date('Y-m-d');
	$dateIn = date('Y-m-d H:i:s');
	$application = $_POST['application'];
	$user = $_POST['user'];
	$appID = $_POST['appID'];
	$appRemarks = $_POST['tpeArea'] .' - '. $peRemarks;
	$currentArea = 'Plan Evaluation';
	$tpeArea = $_POST['tpeArea'];
	$tpeIncharge = $_POST['tpeIncharge'];
	
	if(!empty($_POST['peAmount'])) {
		$peAmount = $_POST['peAmount'];
	} else {
		$peAmount = 0;
	}

	if($peStatus == 'Receive') {
		$dateReceived = $dateOut .' '. $timeOut;
		$sql = $conn->prepare("UPDATE tracking_plan_evaluation SET dateReceived=?, status=?, remarks=? WHERE id=?");
		$sql->bind_param("ssss", $dateReceived, $peStatus, $peRemarks, $peID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=? WHERE id=?");
			$sql2->bind_param("sss", $currentArea, $appRemarks, $application);
			
			if($sql2->execute()) {
				echo "<script>alert('Status has been updated!');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";
			} else {
				$error = "Error: ". $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";
			}

		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";
		}
		
	} elseif($peStatus == 'Release') {
		$sql3 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=? WHERE id=?");
		$sql3->bind_param("sss", $currentArea, $appRemarks, $application);
		$sql3->execute();

		$sql = $conn->prepare("UPDATE tracking_plan_evaluation SET dateOut=?, timeOut=?, status=?, remarks=? WHERE id=?");
		$sql->bind_param("sssss", $dateOut, $timeOut, $peStatus, $peRemarks, $peID);
		
		if($sql->execute()) {
			$sql10 = $conn->prepare("UPDATE tracking_assessment SET amountDue=?, assessedBy=?, dateTime=?, userID=? WHERE onlineappID=? AND assessedFees=?");
			$sql10->bind_param("ssssss", $peAmount, $tpeIncharge, $dateIn, $LoggedUserID, $application, $tpeArea);

			if($sql10->execute()) {
				update_notifications($appID, $application, $dateIn, $user);
			} else {
				$error = "Error: ". $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'</script>";
			}
		}
	
	} elseif($peStatus == 'Return') {
		$timeIn = '';
		$dateIn = '';
		$dateReceived = '';
		$timeOut = '';
		$dateOut = '';
		$sql8 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=? WHERE id=?");
		$sql8->bind_param("sss", $peStatus, $appRemarks, $application);

		if($sql8->execute()) {
			$sql9 = $conn->prepare("UPDATE tracking_plan_evaluation SET timeIn=?, dateIn=?, dateReceived=?, dateOut=?, timeOut=?, status=?, remarks=? WHERE id=?");
			$sql9->bind_param("ssssssss", $timeIn, $dateIn, $dateReceived, $dateOut, $timeOut, $peStatus, $peRemarks, $peID);

			if($sql9->execute()) {
				update_notifications($appID, $application, $dateIn, $user);
			}
			
		}

	} else {
		echo "<script>alert('What are you doing here?');window.location.href='../../login'</script>";
	}

} else {
	echo "<script>alert('What are you doing here?');window.location.href='../../login'</script>";
}

?>