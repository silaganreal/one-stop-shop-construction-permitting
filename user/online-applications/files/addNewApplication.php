<?php

if(isset($_POST['addNewApplication'])) {

	include "../../includes/connect.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$ownerApplicant = $_POST['ownerApplicant'];
	$projectTitle = $_POST['projectTitle'];
	$taxDeclaration = $_POST['taxDeclaration'];
	$applicantName = $_POST['applicantName'];
	$contactNo = $_POST['contactNo'];
	$emailAdd = $_POST['emailAdd'];
	$userID = $_POST['userID'];
	$regDate = date('Y-m-d');
	$regTime = date('h:i:s');

	$sql = "SELECT contactNo FROM userapplications WHERE contactNo = '$contactNo'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 0) {

		$sql2 = "SELECT * FROM userapplications WHERE userID = '$userID' AND ownerApplicant LIKE '%$ownerApplicant%' AND projectTitle LIKE '%$projectTitle%'";
		$res2 = mysqli_query($conn, $sql2);
		$num2 = mysqli_num_rows($res2);

		if($num2 == 0) {

			$sql3 = $conn->prepare("INSERT INTO userapplications(userID, ownerApplicant, projectTitle, taxDeclaration, applicantName, contactNo, emailAdd, regDate, regTime)VALUES(?,?,?,?,?,?,?,?,?)");
			$sql3->bind_param("sssssssss", $userID, $ownerApplicant, $projectTitle, $taxDeclaration, $applicantName, $contactNo, $emailAdd, $regDate, $regTime);

			if($sql3->execute()) {
				echo "<script>alert('New application saved!');window.location.href='../../online-applications'</script>";
			} else {
				$error = 'Error: '. $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../../online-applications'</script>";
			}

		} else {
			echo "<script>alert('Failed! User with the same info already exist.');window.location.href='../../online-applications'</script>";
		}

	} else {
		echo "<script>alert('Failed! Mobile No already in use.');window.location.href='../../online-applications'</script>";
	}
}

?>