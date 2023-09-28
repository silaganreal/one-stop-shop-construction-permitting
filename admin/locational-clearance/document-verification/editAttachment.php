<?php

include "../../includes2/auth.php";

if(isset($_POST['btnDenyAttachment'])) {

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
	$denySlug = $_POST['denySlug'];

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
			echo "<script>alert('Status has been updated!');window.location.href='../document-verification/?slug=$denySlug'</script>";
		}
	}
}

?>