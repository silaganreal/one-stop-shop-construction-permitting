<?php

if(isset($_POST['updateArea'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$areaStatus = $_POST['areaStatus'];
	$areaRemarks = $_POST['areaRemarks'];
	$trackID = $_POST['trackID'];
	$onlineappID = $_POST['onlineappID'];
	$currentArea = $_POST['currentArea'];
	$userappID = $_POST['userappID'];
	$slug = $_POST['userSlug'];
	$dateOut = date('Y-m-d h:i:s');
	$dateappOut = '';

	if($currentArea == 'Document Verification') {
		$location = 'assessment/?slug='.$slug;
		$location2 = 'document-verification/?slug='.$slug;
		$nextArea = 'Processing Fee';

	} elseif($currentArea == 'Processing Fee') {
		$location = 'receiving/?slug='.$slug;
		$location2 = 'assessment/?slug='.$slug;
		$nextArea = 'Receiving';

	} elseif($currentArea == 'Receiving') {
		$location = 'evaluation/?slug='.$slug;
		$location2 = 'receiving/?slug='.$slug;
		$nextArea = 'Evaluation';

	} elseif($currentArea == 'Evaluation') {
		$location = 'site-inspection/?slug='.$slug;
		$location2 = 'evaluation/?slug='.$slug;
		$nextArea = 'Site Inspection';

	} elseif($currentArea == 'Site Inspection') {
		$location = 'clearance-preparation/?slug='.$slug;
		$location2 = 'site-inspection/?slug='.$slug;
		$nextArea = 'Administrative Fine';

	} elseif($currentArea == 'Administrative Fine') {
		$location = 'approval/?slug='.$slug;
		$location2 = 'clearance-preparation/?slug='.$slug;
		$nextArea = 'Approval';

	} elseif($currentArea == 'Approval') {
		$location = 'releasing/?slug='.$slug;
		$location2 = 'approval/?slug='.$slug;
		$nextArea = 'Releasing';

	} elseif($currentArea == 'Releasing') {
		$location = 'releasing/?slug='.$slug;
		$location2 = 'releasing/?slug='.$slug;
		$nextArea = 'Released';
	}

	if($areaStatus == 'YES') {

		$isCurrentArea = 'Y';
		$isFinished = 'Y';
		$nextTrackID = $trackID + 1;
		
		if($currentArea == 'Releasing') {
			$dateappOut = $dateOut;
		} else {
			$dateappOut = '';
		}

		$sql = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=?, applicationDateOut=? WHERE id=?");
		$sql->bind_param("ssss", $nextArea, $areaRemarks, $dateappOut, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE lc_tracking SET isFinished=?, remarks=?, dateOut=? WHERE id=?");
			$sql2->bind_param("ssss", $isFinished, $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			$sql8 = $conn->prepare("UPDATE lc_tracking SET dateIn=?, isCurrentArea=? WHERE id=?");
			$sql8->bind_param("sss", $dateOut, $isCurrentArea, $nextTrackID);
			$sql8->execute();

			echo "<script>alert('Status has been updated. Forwarded to next step.');window.location.href='$location'</script>";

		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location'</script>";
		}

	}

	if($areaStatus == 'NO') {

		$sql = $conn->prepare("UPDATE onlineapplications SET applicationRemarks=? WHERE id=?");
		$sql->bind_param("ss", $areaRemarks, $onlineappID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE lc_tracking SET remarks=?, dateReceived=? WHERE id=?");
			$sql2->bind_param("sss", $areaRemarks, $dateOut, $trackID);
			$sql2->execute();

			echo "<script>alert('Status has been updated.');window.location.href='$location2'</script>";

		} else {
			$error = 'Error: '. $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='$location2'</script>";
		}

	}

}

?>