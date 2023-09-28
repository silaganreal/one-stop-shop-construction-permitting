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
	$newAttachment_destination = '../../uploads/BUILDING_PERMIT/'. $fileAttachDir . "/{$newAttachment_new_name}";
	move_uploaded_file( $newAttachment_temp, $newAttachment_destination );

	$sql = $conn->prepare("UPDATE attachments SET name=?, file=?, status=? WHERE id=?");
	$sql->bind_param("ssss", $fileAttachName, $newAttachment_new_name, $status, $fileAttachID);

	if($sql->execute()) {
		echo "<script>alert('Attachment has been updated!');window.location.href='../bldgpermit'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../building-permit'</script>";
	}

}

?>