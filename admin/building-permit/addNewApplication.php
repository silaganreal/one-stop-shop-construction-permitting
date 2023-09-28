<?php

if(isset($_POST['addNewApplication'])) {

	include "../includes/connect.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$ownerApplicant = $_POST['ownerApplicant'];
	$projectTitle = $_POST['projectTitle'];
	$taxDeclaration = $_POST['taxDeclaration'];
	$applicantName = $_POST['applicantName'];
	$contactNo = $_POST['contactNo'];
	$emailAdd = $_POST['emailAdd'];
	$userID = $_POST['userID'];
	$regDate = date('Y-m-d');
	$regTime = date('H:i:s');
	$applicationType = 'BUILDING_PERMIT';
	$tdnLocation = $_POST['tdnLocation'];
	$ownerAddress = $_POST['ownerAddress'];
	$tdnKind = $_POST['tdnKind'];

	$sql = "SELECT contactNo FROM userapplications WHERE contactNo = '$contactNo'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 0) {

		$sql2 = "SELECT * FROM userapplications WHERE userID = '$userID' AND ownerApplicant LIKE '%$ownerApplicant%' AND projectTitle LIKE '%$projectTitle%'";
		$res2 = mysqli_query($conn, $sql2);
		$num2 = mysqli_num_rows($res2);

		if($num2 == 0) {

			$sql3 = $conn->prepare("INSERT INTO userapplications(userID, ownerApplicant, ownerAddress, projectTitle, taxDeclaration, applicantName, contactNo, emailAdd, tdnLocation, tdnKind, regDate, regTime)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql3->bind_param("ssssssssssss", $userID, $ownerApplicant, $ownerAddress, $projectTitle, $taxDeclaration, $applicantName, $contactNo, $emailAdd, $tdnLocation, $tdnKind, $regDate, $regTime);

			if($sql3->execute()) {

				$appID = $conn->insert_id;
				$randomChar1 = substr(str_shuffle('1234567890'),0,4);
				$randomChar2 = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,4);
				$slug = $randomChar1 .'-'. $randomChar2;

				$sql4 = "SELECT * FROM onlineapplications WHERE userID = '$userID' AND userappID = '$appID' AND applicationType = '$applicationType' AND applicationStatus != 'Released'";
				$res4 = mysqli_query($conn, $sql4);
				$num4 = mysqli_num_rows($res4);

				if($num4 == 0) {
					$currentArea = 'Receiving';
					$appStatus = 'For Receiving';
					include "fx_bldgpermit.php";
					addNewApplication($userID, $appID, $applicationType, $regDate, $regTime, $currentArea, $appStatus, $slug);
				} else {
					$row4 = mysqli_fetch_assoc($res4);
					if($row4['applicationStatus'] != 'For Receiving') {
						$currentArea = 'Receiving';
						$appStatus = 'For Receiving';
						include "fx_bldgpermit.php";
						addNewApplication($userID, $appID, $applicationType, $regDate, $regTime, $currentArea, $appStatus, $slug);
					} else {
						echo "<script>alert('You still have an application that is still On-Progress. Please wait patiently.');window.location.href='../building-permit'</script>";
					}
				}

			} else {
				$error = 'Error: '. $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../building-permit'</script>";
			}

		} else {
			echo "<script>alert('Failed! User with the same info already exist.');window.location.href='../building-permit'</script>";
		}

	} else {
		echo "<script>alert('Failed! Mobile No already in use.');window.location.href='../building-permit'</script>";
	}
}

?>