<?php

if(isset($_POST['updatePlanEvaluation'])) {

	include "../../includes2/auth.php";
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$evalStatus = $_POST['evalStatus'];
	$evalRemarks = $_POST['evalRemarks'];
	$evalID = $_POST['evalID'];
	$onlineappID = $_POST['onlineappID'];
	$appRemarks = $_POST['evalArea'] .' - '. $evalRemarks;
	$currentArea = 'Evaluation';
	$slug = $_POST['evalSlug'];
	$dateNow = date('Y-m-d h:i:s');

	if($evalStatus == 'Receive') {
		$sql = $conn->prepare("UPDATE lc_evaluation SET dateReceive=?, status=?, remarks=? WHERE id=?");
		$sql->bind_param("ssss", $dateNow, $evalStatus, $evalRemarks, $evalID);

		if($sql->execute()) {
			$sql2 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=? WHERE id=?");
			$sql2->bind_param("sss", $currentArea, $appRemarks, $onlineappID);
			$sql2->execute();

			echo "
				<script>
					alert('Status has been updated!');
					window.location.href='../evaluation/?slug=$slug'
				</script>
			";
		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "
				<script>
					alert('$error_implode');
					window.location.href='../evaluation/?slug=$slug'
				</script>
			";
		}

	} elseif($evalStatus == 'Release') {
		$sql = $conn->prepare("UPDATE lc_evaluation SET dateOut=?, status=?, remarks=? WHERE id=?");
		$sql->bind_param("ssss", $dateNow, $evalStatus, $evalRemarks, $evalID);

		if($sql->execute()) {

			$sql2 = $conn->prepare("UPDATE onlineapplications SET currentArea=?, applicationRemarks=? WHERE id=?");
			$sql2->bind_param("sss", $currentArea, $appRemarks, $onlineappID);
			$sql2->execute();
			
			if($sql2->execute()) {
				echo "
					<script>
						alert('Status has been updated!');
						window.location.href='../evaluation/?slug=$slug'
					</script>
				";
			} else {
				$error = "Error: ". $conn->error;
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "
					<script>
						alert('$error_implode');
						window.location.href='../evaluation/?slug=$slug'
					</script>
				";
			}
			
		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "
				<script>
					alert('$error_implode');
					window.location.href='plan-evaluation.php?application=$application&user=$user&appID=$appID'
				</script>";
		}
	}

} else {
	echo "
		<script>
			alert('What are you doing here?');
			window.location.href='../../../login'
		</script>
	";
}

?>