<?php
session_start();
if(isset($_GET['id'])) {

	include "../../../includes/connect.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$loginSession = $_SESSION['bldgpermitAdmin'];
	$sqlLoggedUser = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
	$resLoggedUser = mysqli_query($conn, $sqlLoggedUser);
	$rowLoggedUser = mysqli_fetch_assoc($resLoggedUser);
	$LoggedUserID = $rowLoggedUser['reg_id'];
	$LoggedUserName = $rowLoggedUser['reg_fname'] ." ". $rowLoggedUser['reg_lname'];

	$id = $_GET['id'];
	$app = $_GET['app'];
	$status = 'Verified';
	$remarks = 'Attachment Okay';
	$date = date('Y-m-d h:i:s');

	$sql = "UPDATE attachments SET status = '$status', remarks = '$remarks', date = '$date' WHERE id = '$id'";
	if(mysqli_query($conn, $sql)) {

		$sql3 = "SELECT * FROM attachments WHERE id = '$id'";
		$res3 = mysqli_query($conn, $sql3);
		$row3 = mysqli_fetch_assoc($res3);

		$name = $row3['name'];
		$file = $row3['file'];
		$fdir = $row3['folderDirectory'];

		$sql2 = $conn->prepare("INSERT INTO attachments_remarks(attachmentID,remarks,remarksBy,dateTime,name,file,folderDirectory)VALUES(?,?,?,?,?,?,?)");
		$sql2->bind_param("sssssss", $id, $remarks, $LoggedUserName, $date, $name, $file, $fdir);

		if($sql2->execute()) {
			echo "<script>alert('Success!');window.location.href='view.php?application=$app'</script>";
		}

	} else {
		echo "<script>alert('Error!');window.location.href='../building-permit'</script>";
	}
}

?>