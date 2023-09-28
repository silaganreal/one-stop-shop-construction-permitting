<?php
session_start();

include "../admin/includes/connect.php";

date_default_timezone_set("Asia/Kuala_Lumpur");
$date_in = date('Y-m-d H:i:s');
$day_in = date('Y-m-d');
$time_in = date('H:i:s');

if(isset($_POST['signup'])) {

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$useruu = $_POST['email'];
	$passuu = $_POST['pass'];

	if(!empty($_POST['fbID'])) {
		$fbID = $_POST['fbID'];
	} else {
		$fbID = '';
	}

	$sql4 = "SELECT * FROM arta_registration WHERE reg_mobile = '$mobile'";
	$res4 = mysqli_query($conn, $sql4);
	$num4 = mysqli_num_rows($res4);

	if($num4 == 0) {
		require 'fx_signup.php';
		signup($fname, $lname, $mobile, $useruu, $passuu, $date_in, $fbID);

	} else {
		$row4 = mysqli_fetch_assoc($res4);
		$rowVerified = $row4['verified'];
		$verified = 'N';
		$sms = '0';

		if($rowVerified == 'N') {
			$sql5 = $conn->prepare("UPDATE arta_registration SET verified=?, sms=? WHERE reg_mobile=?");
			$sql5->bind_param("sss", $verified, $sms, $mobile);
			$sql5->execute();
			echo "<script>alert('User has been updated!');window.location.href='../signup';</script>";

		} else {
			$sql3 = "SELECT * FROM arta_registration_unrestricted WHERE reg_mobile = '$mobile'";
			$res3 = mysqli_query($conn, $sql3);
			$num3 = mysqli_num_rows($res3);

			if($num3 > 0) {
				$sql6 = $conn->prepare("UPDATE arta_registration SET verified=?, sms=?, fbID=? WHERE reg_mobile=?");
				$sql6->bind_param("ssss", $verified, $sms, $fbID, $mobile);
				$sql6->execute();
				echo "<script>alert('User has been updated!');window.location.href='../signup';</script>";

			} else {
				echo "<script>alert('User with the same info found on the database!');window.location.href='../signup';</script>";
			}
		}
	}
}

if(isset($_POST['verify'])) {

	$otp = $_POST['otp'];
	$reg_id = $_POST['reg_id'];
	$reg_mobile = $_POST['reg_mobile'];
	$loginSession = $_POST['loginSession'];

	$sql = "SELECT * FROM arta_registration WHERE reg_id = '$reg_id' AND reg_mobile = '$reg_mobile' AND OTP = '$otp'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 1) {
		$sql2 = "UPDATE arta_registration SET verified = 'Y' WHERE reg_id = '$reg_id'";
		if(mysqli_query($conn, $sql2)) {
			$_SESSION['bldgpermit'] = $loginSession;
			// header("location: ../user");
			echo "<script>alert('Success!');window.location.href='../user'</script>";
		} else {
			$error = "Error: ". mysqli_error($conn);
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='otp.php?account=$reg_id&mobile=$reg_mobile'</script>";
		}
		
	} else {
		echo "<script>alert('Incorrect OTP!');window.location.href='otp.php?account=$reg_id&mobile=$reg_mobile'</script>";
	}
}

?>