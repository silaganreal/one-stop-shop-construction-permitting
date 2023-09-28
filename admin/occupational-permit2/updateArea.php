<?php

if(isset($_POST['updateArea'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$areaRemarks = $_POST['areaRemarks'];
	$areaStatus = $_POST['areaStatus'];
	$trackID = $_POST['trackID'];
	$onlineappID = $_POST['onlineappID'];
	$currentArea = $_POST['currentArea'];
	$dateOut = date('Y-m-d h:i:s');
	$userappID = $_POST['userappID'];
	$dateappOut = '';

	if($currentArea == 'Receiving') {
		$nextArea = 'For Document Verification';
		$location = 'document-verification.php';
		$location2 = 'receiving.php';
	} elseif($currentArea == 'Document Verification') {
		$nextArea = 'Plan Evaluation';
		$location = 'plan-evaluation.php';
		$location2 = 'document-verification.php';
	} elseif($currentArea == 'Plan Evaluation') {
		$nextArea = 'Assessment';
		$location = 'assessment.php';
		$location2 = 'plan-evaluation.php';
	} elseif($currentArea == 'Assessment') {
		$nextArea = 'Approval';
		$location = 'approval.php';
		$location2 = 'assessment.php';
	} elseif($currentArea == 'Approval') {
		$nextArea = 'Assessment Releasing';
		$location = 'assessment-releasing.php';
		$location2 = 'approval.php';
	} elseif($currentArea == 'Assessment Releasing') {
		$nextArea = 'Payment';
		$location = 'payment.php';
		$location2 = 'assessment-releasing.php';
	} elseif($currentArea == 'Payment') {
		$nextArea = 'Releasing';
		$location = 'releasing.php';
		$location2 = 'payment.php';
	} elseif($currentArea == 'Releasing') {
		$nextArea = 'Released';
		$location = 'releasing.php';
		$location2 = 'releasing.php';
	}

	if($areaStatus == 'YES') {

		$isFinished = 'Y';
		$isCurrentArea = 'Y';
		$nextTrackID = $trackID + 1;
		$newNextArea = "<span class='text-info'>Forwarded</span> - <span style='color:#009900;'>". $nextArea ."</span>";
		
		if($currentArea == 'Releasing') {
			$dateappOut = $dateOut;
			$currentArea = 'Released';
		} else {
			$dateappOut = '';
			$currentArea = $currentArea;
		}

		$sql = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationStatus=?, applicationRemarks=?, applicationDateOut=? WHERE id=?");
		$sql->bind_param("sssss", $currentArea, $newNextArea, $areaRemarks, $dateappOut, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE tracking SET isFinished=?, remarks=?, dateOut=? WHERE id=?");
			$sql2->bind_param("ssss", $isFinished, $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			$sql6 = "SELECT * FROM notifications WHERE userappID = '$userappID' AND onlineappID = '$onlineappID' ORDER BY dateIn DESC LIMIT 1";
			$res6 = mysqli_query($conn, $sql6);
			$num6 = mysqli_num_rows($res6);

			if($num6 > 0) {
				$row6 = mysqli_fetch_assoc($res6);
				$notifID = $row6['id'];
				$notifStat = $row6['status'];
				if($notifStat === 'N') {
					$sql7 = $conn->prepare("UPDATE notifications SET status=?, dateIn=? WHERE id=?");
					$sql7->bind_param("sss", $notifStat, $dateOut, $notifID);
					$sql7->execute();
					echo "<script>alert('Status has been updated. Forwarded to next step.');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
				} else {
					$sql5 = $conn->prepare("INSERT INTO notifications(userappID, onlineappID, dateIn) VALUES(?,?,?)");
					$sql5->bind_param("sss", $userappID, $onlineappID, $dateOut);
					$sql5->execute();
					echo "<script>alert('Status has been updated. Forwarded to next step.');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
				}
			} else {
				$sql6 = $conn->prepare("INSERT INTO notifications(userappID, onlineappID, dateIn) VALUES(?,?,?)");
				$sql6->bind_param("sss", $userappID, $onlineappID, $dateOut);
				$sql6->execute();
				echo "<script>alert('Status has been updated. Forwarded to next step.');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
			}
		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
		}

	}

	if($areaStatus == 'NO') {

		$deniedStatus = "<span class='text-warning'>Received</span> - <span style='color:#009900;'>". $currentArea ."</span>";
		$isFinished = 'N';

		$sql = $conn->prepare("UPDATE onlineapplications SET applicationStatus=?, applicationRemarks=? WHERE id=?");
		$sql->bind_param("sss", $deniedStatus, $areaRemarks, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE tracking SET isFinished=?, remarks=?, dateReceived=? WHERE id=?");
			$sql2->bind_param("ssss", $isFinished, $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			echo "<script>alert('Status has been updated.');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";

		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
		}

	}

}

?>