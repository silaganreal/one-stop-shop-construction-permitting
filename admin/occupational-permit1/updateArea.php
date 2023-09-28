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

		$sql = $conn->prepare("UPDATE onlineapplications SET applicationStatus=?, applicationRemarks=?, applicationDateOut=? WHERE id=?");
		$sql->bind_param("ssss", $nextArea, $areaRemarks, $dateOut, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE tracking SET isFinished=?, remarks=?, dateOut=? WHERE id=?");
			$sql2->bind_param("ssss", $isFinished, $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			$sql3 = $conn->prepare("UPDATE tracking SET dateIn=?, isCurrentArea=? WHERE id=?");
			$sql3->bind_param("sss", $dateOut, $isCurrentArea, $nextTrackID);
			$sql3->execute();

			if($currentArea == 'Document Verification') {
				$timeIn = date('h:i:s');
				$dateIn = date('Y-m-d');
				$sql4 = $conn->prepare("UPDATE tracking_plan_evaluation SET timeIn=?, dateIn=? WHERE onlineappID=?");
				$sql4->bind_param("sss", $timeIn, $dateIn, $onlineappID);
				$sql4->execute();
			}

			echo "<script>alert('Status has been updated. Forwarded to next step.');window.location.href='$location?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";

		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
		}

	}

	if($areaStatus == 'NO') {

		$deniedStatus = "<span style='color:red;'>Denied - ". $currentArea ."</span>";
		$isFinished = 'N';

		$sql = $conn->prepare("UPDATE onlineapplications SET applicationStatus=?, applicationRemarks=?, applicationDateOut=? WHERE id=?");
		$sql->bind_param("ssss", $deniedStatus, $areaRemarks, $dateOut, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE tracking SET isFinished=?, remarks=?, dateOut=? WHERE id=?");
			$sql2->bind_param("ssss", $isFinished, $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			echo "<script>alert('Status has been updated. Application has been denied.');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";

		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location2?application=$onlineappID&user=$LoggedUserID&appID=$userappID'</script>";
		}

	}

}

?>