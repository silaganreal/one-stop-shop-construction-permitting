<?php

if(isset($_POST['updateFront'])) {

	include "../includes/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$frontForwarded = $_POST['frontForwarded'];
	$frontNotifID = $_POST['frontNotifID'];
	$frontOnlineappID = $_POST['frontOnlineappID'];

	if($frontForwarded == 'Returned') {
		$status = 'N';
	} else {
		$status = 'Y';
	}

	$isCurrentArea = 'Y';
	$dateOut = date('Y-m-d h:i:s');
	$deyt = date('Y-m-d');

	if($frontForwarded == 'Receiving' || $frontForwarded == 'Document Verification' || $frontForwarded == 'Assessment' || $frontForwarded == 'Releasing' || $frontForwarded == 'Released' || $frontForwarded == 'Returned') {

		$sql = $conn->prepare("UPDATE notifications SET status=?, dateOut=? WHERE id=?");
		$sql->bind_param("sss", $status, $dateOut, $frontNotifID);

		if($sql->execute()) {

			if($frontForwarded != 'Released') {
				
				$sql2 = $conn->prepare("UPDATE onlineapplications SET currentArea=? WHERE id=?");
				$sql2->bind_param("ss", $frontForwarded, $frontOnlineappID);
				
				if($sql2->execute()) {

					$sql3 = $conn->prepare("UPDATE tracking SET dateIn=?, isCurrentArea=? WHERE onlineappID=? AND area=?");
					$sql3->bind_param("ssss", $dateOut, $isCurrentArea, $frontOnlineappID, $frontForwarded);
					
					if($sql3->execute()) {
						echo "<script>alert('Document forwarded.');window.location.href='../frontline'</script>";
					} else {
						$error = "Error: ". $conn->error;
						$error_explode = explode("'", $error);
						$error_implode = implode("", $error_explode);
						echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
					}

				} else {
					$error = "Error: ". $conn->error;
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
				}

			} else {
				$newRemarks = 'Permit handed to client';
				$frontAppType = $_POST['frontAppType'];
				$frontProjectTitle = $_POST['frontProjectTitle'];
				$orno = '';
				$oramt = '';

				$sql4 = $conn->prepare("UPDATE onlineapplications SET applicationRemarks=? WHERE id=?");
				$sql4->bind_param("ss", $newRemarks, $frontOnlineappID);
				
				if($sql4->execute()) {
					$sql6 = $conn3->prepare("INSERT INTO dtaengreleaseinfo(transid, cnameapp, ptype, prdate, orno, ordate, oramt) VALUES(?,?,?,?,?,?,?)");
					$sql6->bind_param("sssssss", $frontOnlineappID, $frontProjectTitle, $frontAppType, $deyt, $orno, $deyt, $oramt);

					if($sql6->execute()) {
						echo "<script>alert('$newRemarks.');window.location.href='../frontline'</script>";
					} else {
						$error = "Error: ". $conn3->error;
						$error_explode = explode("'", $error);
						$error_implode = implode("", $error_explode);
						echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
					}
				} else {
					$error = "Error: ". $conn->error;
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
				}
			}

		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
		}

	} else {

		$sql = $conn->prepare("UPDATE notifications SET status=?, dateOut=? WHERE id=?");
		$sql->bind_param("sss", $status, $dateOut, $frontNotifID);

		if($sql->execute()) {

			$frontName = 'Plan Evaluation';
			$timeIn = date('h:i:s');
			$dateIn = date('Y-m-d');

			$sql5 = "SELECT * FROM tracking_plan_evaluation WHERE id = '$frontForwarded'";
			$res5 = mysqli_query($conn, $sql5);
			$row5 = mysqli_fetch_assoc($res5);
			$tpeName = $row5['area'];

			$sql2 = $conn->prepare("UPDATE tracking_plan_evaluation SET timeIn=?, dateIn=? WHERE id=?");
			$sql2->bind_param("sss", $timeIn, $dateIn, $frontForwarded);
			
			if($sql2->execute()) {

				$sql3 = $conn->prepare("UPDATE tracking SET dateIn=?, isCurrentArea=? WHERE onlineappID=? AND area=?");
				$sql3->bind_param("ssss", $dateOut, $isCurrentArea, $frontOnlineappID, $frontName);
				
				if($sql3->execute()) {

					$newFrontName = "<span class='text-warning'>". $frontName ."</span> - <span style='color:#009900;'>". $tpeName ."</span>";

					$sql4 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationStatus=? WHERE id=?");
					$sql4->bind_param("sss", $frontName, $newFrontName, $frontOnlineappID);

					if($sql4->execute()) {
						echo "<script>alert('Document forwarded.');window.location.href='../frontline'</script>";
					} else {
						$error = "Error: ". $conn->error;
						$error_explode = explode("'", $error);
						$error_implode = implode("", $error_explode);
						echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
					}
					
				} else {
					$error = "Error: ". $conn->error;
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
				}

			} else {
				$error = "Error: ". $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
			}

		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../frontline'</script>";
		}

	}

}

?>