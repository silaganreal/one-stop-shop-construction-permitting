<?php

include "../includes/auth.php";

if(isset($_POST['btnUpdateAttachment'])) {

	include "../includes/connect.php";
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date('Y-m-d h:i:s');
	$timeStamp = time();

	// $newAttachment = $_POST['newAttachment'];
	$fileAttachID = $_POST['fileAttachID'];
	$fileAttachName = $_POST['fileAttachName'];
	$fileAttachDir = $_POST['fileAttachDir'];
	$fileAttachAppID = $_POST['fileAttachAppID'];

	$status = 'For Verification';
	$newFileName = $fileAttachName .'-'. $timeStamp;

	$newAttachment = $_FILES['newAttachment']['name'];
	$newAttachment_name = $_FILES['newAttachment']['name'];
	$newAttachment_type = $_FILES['newAttachment']['type'];
	$newAttachment_size = $_FILES['newAttachment']['size'];
	$newAttachment_temp = $_FILES['newAttachment']['tmp_name'];
	$newAttachment_exte = pathinfo($newAttachment_name, PATHINFO_EXTENSION);

	$newAttachment_new_name = $newFileName .".". $newAttachment_exte;
	$newAttachment_destination = '../../uploads'. $fileAttachDir . "/{$newAttachment_new_name}";
	move_uploaded_file( $newAttachment_temp, $newAttachment_destination );

	$sql = $conn->prepare("UPDATE attachments SET name=?, file=?, status=? WHERE id=?");
	$sql->bind_param("ssss", $fileAttachName, $newAttachment_new_name, $status, $fileAttachID);

	if($sql->execute()) {
		echo "<script>alert('Attachment has been updated!');window.location.href='view.php?application=$fileAttachAppID'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='view.php?application=$fileAttachAppID'</script>";
	}

}

if(isset($_POST['btnDenyAttachment'])) {

	include "../includes/connect.php";
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date('Y-m-d h:i:s');

	$loginSession = $_SESSION['bldgpermitAdmin'];
	$sqlLoggedUser = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
	$resLoggedUser = mysqli_query($conn, $sqlLoggedUser);
	$rowLoggedUser = mysqli_fetch_assoc($resLoggedUser);
	$LoggedUserID = $rowLoggedUser['reg_id'];
	$LoggedUserName = $rowLoggedUser['reg_fname'] ." ". $rowLoggedUser['reg_lname'];

	$denyReason = $_POST['denyReason'];
	$denyAttachID = $_POST['denyAttachID'];
	$fileAttachAppID = $_POST['denyAttachAppID'];
	$status = 'Denied';
	$denyResponsible = $_POST['denyResponsible'];
	$userappID = $_POST['userappID'];

	$sql = $conn->prepare("UPDATE attachments SET status=?, remarks=?, date=? WHERE id=?");
	$sql->bind_param("ssss", $status, $denyReason, $date, $denyAttachID);

	if($sql->execute()) {

		$sql3 = "SELECT * FROM attachments WHERE id = '$denyAttachID'";
		$res3 = mysqli_query($conn, $sql3);
		$row3 = mysqli_fetch_assoc($res3);

		$name = $row3['name'];
		$file = $row3['file'];
		$fdir = $row3['folderDirectory'];

		$sql2 = $conn->prepare("INSERT INTO attachments_remarks(attachmentID,remarks,remarksBy,dateTime,name,file,folderDirectory)VALUES(?,?,?,?,?,?,?)");
		$sql2->bind_param("sssssss", $denyAttachID, $denyReason, $LoggedUserName, $date, $name, $file, $fdir);

		if($sql2->execute()) {
			echo "<script>alert('Status has been updated!');window.location.href='document-verification.php?application=$fileAttachAppID&user=$LoggedUserID&appID=$userappID'</script>";
		}
	}
}

?>