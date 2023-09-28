<?php

function signup($fname, $lname, $mobile, $useruu, $passuu, $date_in, $fbID) {

	require '../admin/includes/connect.php';

	$randomChar = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,3);
	$randomNum = substr(str_shuffle("123456789"),0,3);
	$otp = substr(str_shuffle("123456789"),0,4);
	$loginSession = $randomChar ."-". $randomNum;
	$status = '2';
	$verified = 'N';

	$sql2 = $conn->prepare("INSERT INTO arta_registration(reg_fname, reg_lname, reg_mobile, reg_username, reg_password, status, reg_date, OTP, verified, loginSession, fbID) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
	$sql2->bind_param("sssssssssss", $fname, $lname, $mobile, $useruu, $passuu, $status, $date_in, $otp, $verified, $loginSession, $fbID);

	if($sql2->execute()) {

		$lastID = $conn->insert_id;
		header('location: otp.php?account='.$lastID.'&mobile='.$mobile);

	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../signup'</script>";
	}

}

?>