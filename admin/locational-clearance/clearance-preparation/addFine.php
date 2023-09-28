<?php
session_start();
if(isset($_SESSION['bldgpermitAdmin'])) {
	if(isset($_POST['AddFine'])) {

		require '../../includes2/auth.php';
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$dateNow = date('Y-m-d h:i:s');

		$assessedFee = $_POST['assessedFee'];
		$amountDue = $_POST['amountDue'];
		$assessedBy = $_POST['assessedBy'];
		$onlineappID = $_POST['onlineappID'];
		$userSlug = $_POST['userSlug'];

		$sql = "SELECT * FROM lc_assessment2 WHERE onlineappID = '$onlineappID' AND assessedFees = '$assessedFee'";
		$res = mysqli_query($conn, $sql);

		if(mysqli_num_rows($res) <= 0) {

			$sql = $conn->prepare("INSERT INTO lc_assessment2(onlineappID, assessedFees, amountDue, assessedBy, dateTime, userID) VALUES(?,?,?,?,?,?)");
			$sql->bind_param("ssssss", $onlineappID, $assessedFee, $amountDue, $assessedBy, $dateNow, $LoggedUserID);

			if($sql->execute()) {
				echo "
					<script>
						alert('New Fine has been addedd!');
						window.location.href='../clearance-preparation/?slug=$userSlug'
					</script>
				";
			} else {
				$error = "Error: ". $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "
					<script>
						alert('$error_implode');
						window.location.href='../clearance-preparation/?slug=$userSlug'
					</script>
				";
			}

		}		

	} else {
		header('location: ../../../login');
	}
} else {
	header('location: ../../../login');
}
?>