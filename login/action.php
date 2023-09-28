<?php
session_start();

include "../admin/includes/connect.php";

date_default_timezone_set("Asia/Kuala_Lumpur");
$date_in = date('Y-m-d H:i:s');
$day_in = date('Y-m-d');
$time_in = date('H:i:s');

if(isset($_POST['login'])) {

	$user = $_POST['email'];
	$pass = $_POST['pass'];

	// $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
	$sql = "SELECT * FROM arta_registration WHERE reg_username = '$user' AND reg_password = '$pass'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 1) {

		$row = mysqli_fetch_assoc($res);

		if($row['verified'] == 'Y') {

			$loginSession = $row['loginSession'];
			$status = $row['status'];

			if($status == '1') {
				$_SESSION['bldgpermitAdmin'] = $loginSession;
				header("location: ../admin");
			}
			if($status == '2') {
				$_SESSION['bldgpermit'] = $loginSession;
				header("location: ../user");
			}
			if($status == '3') {
				$_SESSION['bldgpermitAdmin'] = $loginSession;
				header("location: ../admin/frontline");
			}
			
		} else {
			echo "<script>alert('Account needs to be Verified. Please contact System Administrator');window.location.href='../login'</script>";
		}

	} else {
		echo "<script>alert('User not found!');window.location.href='../login'</script>";
	}
}

?>
